<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetQuaThi;
use App\Exports\KetQuaThiExport;
use Maatwebsite\Excel\Facades\Excel;

class KetQuaThiController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $ketQua = KetQuaThi::all();
        $this->viewData['title'] = "Danh sách kết quả thi";
        $this->viewData['ketQuaThi'] = $ketQua;
        return view('ketQuaThi.index', ['viewData' => $this->viewData]);
    }

    public function exportExcel()
    {
        try {
            return Excel::download(new KetQuaThiExport, 'ket_qua_thi.xlsx');
        } catch (\Exception $e) {
            // Ghi log lỗi
            \Log::error('Export Excel Error: ' . $e->getMessage());
            // Hiển thị lỗi ra màn hình (chỉ nên dùng khi debug)
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
