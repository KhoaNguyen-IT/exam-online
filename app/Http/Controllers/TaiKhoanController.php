<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\PhanQuyenTaiKhoan;
use App\Models\PhanQuyen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TaiKhoanController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $taiKhoan = TaiKhoan::all();
        $this->viewData['title'] = 'Danh sách tài khoản';
        $this->viewData['taiKhoan'] = $taiKhoan;

        return view('taikhoan.index', ['viewData' => $this->viewData]);
    }
    public function show($id)
    {
        $this->viewData['title'] = 'Chi tiết tài khoản';
        $this->viewData['taiKhoan'] = TaiKhoan::findOrFail($id);
        $this->viewData['chiTietPhanQuyen'] = PhanQuyenTaiKhoan::where('maTK', $id)->get();

        return view('taikhoan.detail', ['viewData' => $this->viewData]);
    }
    public function create()
    {
        $this->viewData['title'] = 'Tạo tài khoản';
        return view('taikhoan.create', ['viewData' => $this->viewData]);
    }

    public function addTaiKhoan(Request $request)
    {
        $request->validate([
            'hoTen' => 'required|string|max:255',
            'email' => 'required|email|unique:tai_khoan,email',
            'matKhau' => 'required|string|min:6',
            'vaiTro' => 'required|in:giangVien,sinhVien',
        ]);

        $taiKhoan = new TaiKhoan();
        $taiKhoan->setHoTen($request->input('hoTen'));
        $taiKhoan->setEmail($request->input('email'));
        $taiKhoan->setMatKhau(bcrypt($request->input('matKhau')));
        $taiKhoan->setVaiTro($request->input('vaiTro'));
        $taiKhoan->save();

        return redirect()->route('taikhoan.index')->with('success', 'Tạo tài khoản thành công!');
    }

    public function getProfileAdmin()
    {
        $this->viewData['user'] = Auth::user();

        return view('profile.adminProfile', ['viewData' => $this->viewData]);
    }

    public function getProfileTeacher()
    {
        $this->viewData['user'] = Auth::user();

        return view('profile.teacherProfile', ['viewData' => $this->viewData]);
    }

    public function updateProfile(Request $request, string $id)
    {
        $request->validate(
            [
                'anhDaiDien' => 'nullable|image|mimes:png,jpg,jpge,gif|max: 2048',
                'hoTen' => 'nullable|string|max:50',
                'matKhauCu' => 'nullable|string',
                'matKhauMoi' => 'nullable|string|min:8|confirmed',
            ],
            [
                'matKhauMoi.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
                'matKhauMoi.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            ]
        );

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

        if ($request->filled('hoTen') && $request->hoTen !== $taiKhoan->hoTen) {
            $taiKhoan->hoTen = $request->hoTen;

            $status = true;
        }

        if ($request->filled('matKhauCu') && $request->filled('matKhauMoi')) {
            if (!Hash::check($request->matKhauCu, $taiKhoan->matKhau)) {
                return back()->with('error', 'Mật khẩu củ không chính xác!');
            } else {
                $taiKhoan->matKhau = Hash::make($request->matKhauMoi);

                if ($taiKhoan->doiMK == 0) {
                    $taiKhoan->doiMK = 1;
                }

                $status = true;
            }
        } else if ($request->filled('matKhauMoi')) {
            return back()->with('error', 'Bạn chưa nhập mật khẩu củ!');
        } else if ($request->filled('matKhauCu')) {
            return back()->with('error', 'Bạn chưa nhập mật khẩu mới!');
        }

        if ($status == true) {
            $taiKhoan->save();

            Cookie::queue('userAvatar', $taiKhoan->anhDaiDien, 24 * 60);
            Cookie::queue('userName', $taiKhoan->hoTen, 24 * 60);

            return back()->with('updateInfoSuccess', 'Thông tin tài khoản của bạn đã được cập nhật.');
        }

        return back();
    }
}
