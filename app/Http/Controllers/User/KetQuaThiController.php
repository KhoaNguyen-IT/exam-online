<?php

namespace App\Http\Controllers\User;

use App\Models\KetQuaThi;
use App\Models\NhanXet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetQuaThiController extends Controller
{
    public $viewData = [];

    public function index(string $id)
    {
        $this->viewData['title'] = 'Trang kết quả bài thi | Trắc nghiệm';

        $ketQuaThi = KetQuaThi::with([
            'deThi.monHoc',
            'deThi.kyThi',
            'baiLam.chiTietBaiLams.cauHoi'
        ])->where('maKQT', $id)->firstOrFail();

        $kyThi = $ketQuaThi->deThi->kyThi;
        $thoiLuong = $ketQuaThi->deThi->thoiLuongPhut;

        if ($kyThi && $thoiLuong) {
            $ngayThi = Carbon::parse($kyThi->ngayThi);
            $thoiGianKetThuc = $ngayThi->copy()->addMinutes($thoiLuong);
            $daKetThuc = now()->greaterThan($thoiGianKetThuc);
        } else {
            $daKetThuc = null;
        }

        $this->viewData['ketQuaThi'] = $ketQuaThi;
        $this->viewData['daKetThuc'] = $daKetThuc;

        return view('user.testDetail', ['viewData' => $this->viewData]);
    }

    public function guiNhanXet(Request $request, string $id)
    {
        $userId = Auth::user()->maTK;

        $noiDungNhanXet = $request->noiDungNhanXet;

        NhanXet::create([
            'maTK' => $userId,
            'maDT'   => $id,
            'noiDung' => $noiDungNhanXet,
        ]);

        return back()->with('guiNhanXetThanhCong', 'Nhận xét của bạn đã được lưu vào hệ thống');
    }
}
