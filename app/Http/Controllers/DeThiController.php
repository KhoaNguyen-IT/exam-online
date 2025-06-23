<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\ChiTietDeThi;
use App\Models\MonHoc;
use App\Models\CauHoi;

class DeThiController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $this->viewData['title'] = "Danh sách Đề thi";
        $this->viewData['deThi'] = DeThi::all();
        return view('deThi.index', ['viewData' => $this->viewData]);
    }

    public function show($id)
    {
        $deThi = DeThi::findOrFail($id);
        $chiTietDeThi = ChiTietDeThi::where('maDT', $id)->get();

        $this->viewData['title'] = "Chi tiết Đề thi";
        $this->viewData['deThi'] = $deThi;
        $this->viewData['chiTietDeThi'] = $chiTietDeThi;

        return view('deThi.detail', ['viewData' => $this->viewData]);
    }

    public function create()
    {
        $this->viewData['title'] = "Tạo Đề thi";
        $this->viewData['monHoc'] = MonHoc::all();
        $this->viewData['cauHoi'] = CauHoi::all();
        return view('deThi.create', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $deThi = DeThi::findOrFail($id);
        $chiTietDeThi = ChiTietDeThi::where('maDT', $id)->get();
        $this->viewData['title'] = "Chỉnh sửa Đề thi";
        $this->viewData['deThi'] = $deThi;
        $this->viewData['monHoc'] = MonHoc::all();
        $this->viewData['cauHoi'] = CauHoi::all();
        $this->viewData['chiTietDeThi'] = $chiTietDeThi;
        return view('dethi.update', ['viewData' => $this->viewData]);
    }

    public function addDeThi(Request $request)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'thoiLuong' => 'required|integer|min:1',
            'cau_hoi_ids' => 'required|array|min:1',
            'cau_hoi_ids.*' => 'exists:cau_hoi,maCH',
        ]);

        $deThi = new DeThi();
        $deThi->setTenDT($request->input('tenDT'));
        $deThi->maMH = $request->input('monHoc');
        $deThi->setThoiLuongPhut($request->input('thoiLuong'));
        $deThi->setMoTa($request->input('moTa') ?? '');
        $deThi->maTK = auth()->user()->maTK;
        $deThi->ngayTao = now();
        $deThi->save();

        foreach ($request->input('cau_hoi_ids') as $maCH) {
            $chiTiet = new ChiTietDeThi();
            $chiTiet->maDT = $deThi->maDT;
            $chiTiet->maCH = $maCH;
            $chiTiet->save();
        }

        return redirect()->route('dethi.index')->with('success', 'Tạo đề thi thành công!');
    }

    public function updateDeThi(Request $request, $id)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'thoiLuong' => 'required|integer|min:1',
            'cau_hoi_ids' => 'required|array|min:1',
            'cau_hoi_ids.*' => 'exists:cau_hoi,maCH',
        ]);

        $deThi = DeThi::findOrFail($id);
        $deThi->setTenDT($request->input('tenDT'));
        $deThi->maMH = $request->input('monHoc');
        $deThi->setThoiLuongPhut($request->input('thoiLuong'));
        $deThi->setMoTa($request->input('moTa') ?? '');
        $deThi->save();

        // Xóa các chi tiết đề thi cũ
        ChiTietDeThi::where('maDT', $id)->delete();

        // Thêm lại các chi tiết đề thi mới
        foreach ($request->input('cau_hoi_ids') as $maCH) {
            $chiTiet = new ChiTietDeThi();
            $chiTiet->maDT = $deThi->maDT;
            $chiTiet->maCH = $maCH;
            $chiTiet->save();
        }

        return redirect()->route('dethi.index')->with('success', 'Cập nhật đề thi thành công!');
    }
}
