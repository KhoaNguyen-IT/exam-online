<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KetQuaThi;
use App\Models\TaiKhoan;
use App\Models\KyThi;
use App\Exports\KetQuaThiExport;
use Maatwebsite\Excel\Facades\Excel;

class KetQuaThiController extends Controller
{
    public $viewData = [];

    public function index(Request $request)
    {
        // Nếu có chọn sinh viên
        if ($request->has('maTK')) {
            $maTK = $request->query('maTK');
            $this->viewData['sinhVien'] = TaiKhoan::findOrFail($maTK);
            $this->viewData['ketQuaThi'] = KetQuaThi::where('maTK', $maTK)->with(['deThi', 'taiKhoan'])->get();
            $this->viewData['title'] = 'Kết quả thi của sinh viên';
            return view('ketQuaThi.dsTheoSinhVien', ['viewData' => $this->viewData]);
        }

        // Mặc định hiển thị danh sách sinh viên
        $this->viewData['title'] = "Danh sách thí sinh";
        $this->viewData['sinhVienList'] = TaiKhoan::where('vaiTro', 'sinhVien')->get();
        return view('ketQuaThi.dsSinhVien', ['viewData' => $this->viewData]);
    }

    public function exportExcel($maKT)
    {
        try {
            $kyThi = KyThi::findOrFail($maKT);
            $tenKT = Str::slug($kyThi->getTenKT());

            $fileName = 'ket_qua_thi_' . $tenKT . '.xlsx';

            return Excel::download(new KetQuaThiExport($maKT), $fileName);
        } catch (\Exception $e) {
            \Log::error('Export Excel Error: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
