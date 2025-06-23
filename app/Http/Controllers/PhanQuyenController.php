<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhanQuyenTaiKhoan;
use App\Models\PhanQuyen;
use App\Models\TaiKhoan;

class PhanQuyenController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $phanQuyen = PhanQuyen::all();
        $this->viewData['title'] = 'Danh sách các phân quyền';
        $this->viewData['phanQuyen'] = $phanQuyen;
        return view('phanquyen.index', ['viewData' => $this->viewData,]);
    }

    public function create($id)
    {
        $this->viewData['title'] = 'Cấp quyền tài khoản';
        $this->viewData['taiKhoan'] = TaiKhoan::findOrFail($id);
        $this->viewData['phanQuyen'] = PhanQuyen::all();
        return view('phanquyen.create', ['viewData' => $this->viewData]);
    }

    public function themQuyenChoTaiKhoan(Request $request, $maTK)
    {
        foreach ($request->quyen_ids as $maPQ) {
            $daTonTai = PhanQuyenTaiKhoan::where('maTK', $maTK)
                ->where('maPQ', $maPQ)
                ->exists();

            if ($daTonTai) {
                return redirect()->route('phanquyen.create', ['id' => $maTK])
                    ->with('error', 'Quyền này đã tồn tại cho tài khoản.');
            } else {
                PhanQuyenTaiKhoan::create([
                    'maTK' => $maTK,
                    'maPQ' => $maPQ,
                ]);
            }
        }

        return redirect()->route('taikhoan.index', ['id' => $maTK])
            ->with('success', 'Thêm quyền cho tài khoản thành công.');
    }
}
