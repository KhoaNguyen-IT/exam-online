<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KyThi;
use App\Models\DeThi;
use App\Models\ChiTietKyThi;

class KyThiController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $kyThi = KyThi::all();
        $this->viewData['title'] = "Danh sách Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;
        return view('kyThi.index', ['viewData' => $this->viewData]);
    }

    public function create()
    {
        $this->viewData['title'] = "Tạo Kỳ thi";
        $deThi = DeThi::all();
        $this->viewData['deThi'] = $deThi;
        return view('kyThi.create', ['viewData' => $this->viewData]);
    }

    public function show($id)
    {
        $kyThi = KyThi::findOrFail($id);
        $chiTietKyThi = ChiTietKyThi::where('maKT', $id)->get();

        $this->viewData['title'] = "Chi tiết Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;
        $this->viewData['chiTietKyThi'] = $chiTietKyThi;

        return view('kyThi.detail', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $kyThi = KyThi::findOrFail($id);
        $deThi = DeThi::all();
        $chiTietKyThi = ChiTietKyThi::where('maKT', $id)->get();

        $this->viewData['title'] = "Chỉnh sửa Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;
        $this->viewData['deThi'] = $deThi;
        $this->viewData['chiTietKyThi'] = $chiTietKyThi;

        return view('kyThi.update', ['viewData' => $this->viewData]);
    }
    public function updateKyThi(Request $request, $id)
    {
        $kyThi = KyThi::findOrFail($id);
        $kyThi->setTenKT($request->input('tenKT'));
        $mota = $request->input('moTa');
        $kyThi->setMoTa($mota ?? '');
        $kyThi->save();

        // Xóa chi tiết kỳ thi cũ
        ChiTietKyThi::where('maKT', $id)->delete();

        // Lưu chi tiết kỳ thi mới cho từng đề thi đã chọn
        $deThiIds = $request->input('de_thi_ids', []);
        foreach ($deThiIds as $maDT) {
            $chiTietKyThi = new ChiTietKyThi();
            $chiTietKyThi->maKT = $kyThi->maKT;
            $chiTietKyThi->maDT = $maDT;
            $chiTietKyThi->save();
        }

        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được cập nhật thành công.');
    }
    public function addKyThi(Request $request)
    {
        $kyThi = new KyThi();
        $kyThi->setTenKT($request->input('tenKT'));
        $mota = $request->input('moTa');
        $kyThi->setMoTa($mota ?? '');
        $kyThi->save();

        // Lưu chi tiết kỳ thi cho từng đề thi đã chọn
        $deThiIds = $request->input('de_thi_ids', []);
        foreach ($deThiIds as $maDT) {
            $chiTietKyThi = new ChiTietKyThi();
            $chiTietKyThi->maKT = $kyThi->maKT;
            $chiTietKyThi->maDT = $maDT;
            $chiTietKyThi->save();
        }

        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được tạo thành công.');
    }
}
