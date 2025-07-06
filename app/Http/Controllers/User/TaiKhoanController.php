<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $viewData = [];

    public function index()
    {
        $this->viewData['title'] = 'Trang thông tin tài khoản | Trắc nghiệm';
        $this->viewData['user'] = Auth::user();
        return view('user.accountInfo', ['viewData' => $this->viewData]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'anhDaiDien' => 'nullable|image|mimes:png,jpg,jpge,gif|max: 2048',
            'hoTen' => 'nullable|string|max:50',
            'matKhauCu' => 'nullable|string',
            'matKhauMoi' => 'nullable|string|min:8|confirmed',
        ], 
        [
            'matKhauMoi.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
            'matKhauMoi.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $status = false;

        $taiKhoan = TaiKhoan::find($id);

        if ($request->hasFile('anhDaiDien')) {
            if ($taiKhoan->anhDaiDien && Storage::disk('public')->exists($taiKhoan->anhDaiDien)) {
                Storage::disk('public')->delete($taiKhoan->anhDaiDien);
            }

            $file = $request->file('anhDaiDien');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $filePath = $file->storeAs('user/images', $fileName, 'public');

            $taiKhoan->anhDaiDien = $filePath;
            
            $status = true;
        }

        if($request->filled('hoTen') && $request->hoTen !== $taiKhoan->hoTen)
        {
            $taiKhoan->hoTen = $request->hoTen;

            $status = true;
        }

        if($request->filled('matKhauCu') && $request->filled('matKhauMoi'))
        {
            if (!Hash::check($request->matKhauCu, $taiKhoan->matKhau)) {
                return back()->with('error', 'Mật khẩu củ không chính xác!');
            } 
            else {
                $taiKhoan->matKhau = Hash::make($request->matKhauMoi);

                if($taiKhoan->doiMK == 0)
                {
                    $taiKhoan->doiMK = 1;
                }

                $status = true;
            }
        } 
        else if ($request->filled('matKhauMoi'))
        {
            return back()->with('error', 'Bạn chưa nhập mật khẩu củ!');
        } 
        else if ($request->filled('matKhauCu')) {
            return back()->with('error', 'Bạn chưa nhập mật khẩu mới!');
        }

        if($status == true)
        {
            $taiKhoan->save();

            Cookie::queue('userAvatar', $taiKhoan->anhDaiDien, 24 * 60);
            Cookie::queue('userName', $taiKhoan->hoTen, 24 * 60);

            return back()->with('updateInfoSuccess', 'Thông tin tài khoản của bạn đã được cập nhật.');
        }

        return back();
    }

    public function updateLastSeenDeThi(string $id)
    {
        $taiKhoan = TaiKhoan::find($id);

        if (!$taiKhoan) {
            return response()->json(null, 404);
        }

        $taiKhoan->last_seen_de_thi_at = now();
        $taiKhoan->save();

        return response()->json(null, 204);
    }
}
