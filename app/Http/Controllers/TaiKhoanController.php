<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\PhanQuyenTaiKhoan;
use App\Models\PhanQuyen;

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
}
