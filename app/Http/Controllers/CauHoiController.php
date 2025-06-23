<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CauHoi;
use App\Models\MonHoc;
use App\Models\DeThi;
use App\Exports\CauHoiExport;
use App\Imports\CauHoiImport;
use Maatwebsite\Excel\Facades\Excel;
class CauHoiController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $this->viewData['title'] = "Danh sách câu hỏi";
        $this->viewData['cauHoi'] = CauHoi::all();
        return view('cauHoi.index', ['viewData' => $this->viewData]);
    }

    public function show($id)
    {
        $this->viewData['title'] = "Chi tiết câu hỏi";
        $this->viewData['chiTietCauHoi'] = CauHoi::findOrFail($id);
        return view('cauHoi.detail', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $this->viewData['title'] = "Chỉnh sửa câu hỏi";
        $this->viewData['chiTietCauHoi'] = CauHoi::findOrFail($id);

        // Lấy danh sách môn học
        $this->viewData['monHoc'] = MonHoc::all();

        return view('cauHoi.update', ['viewData' => $this->viewData]);
    }

    public function create()
    {
        $this->viewData['title'] = "Thêm câu hỏi mới";
        $this->viewData['monHoc'] = MonHoc::all();
        $this->viewData['deThi'] = DeThi::all();

        return view('cauHoi.create', ['viewData' => $this->viewData]);
    }

    public function updateCauHoi(Request $request, $id)
    {
        $request->validate([
            'noiDung' => 'required|string',
            'dapAnA' => 'required|string',
            'dapAnB' => 'required|string',
            'dapAnC' => 'required|string',
            'dapAnD' => 'required|string',
            'dapAnDung' => 'required|in:A,B,C,D',
            'doKho' => 'required|in:Dễ,Trung bình,Khó',
        ], [
            'required' => 'Trường :attribute không được để trống.',
            'in' => 'Trường :attribute không hợp lệ.',
        ]);

        $cauHoi = CauHoi::findOrFail($id);

        // Cập nhật các trường của chi tiết câu hỏi
        $cauHoi->setNoiDung($request->input('noiDung'));
        $cauHoi->setA($request->input('dapAnA'));
        $cauHoi->setB($request->input('dapAnB'));
        $cauHoi->setC($request->input('dapAnC'));
        $cauHoi->setD($request->input('dapAnD'));
        $cauHoi->setDung($request->input('dapAnDung'));
        $cauHoi->setDoKho($request->input('doKho'));
        $cauHoi->setMaMonHoc($request->input('maMonHoc'));
        $cauHoi->save();

        return redirect()->route('cauhoi.edit', ['id' => $id])->with('success', 'Cập nhật câu hỏi thành công!');
    }

    public function addCauHoi(Request $request)
    {
        $request->validate([
            'noiDung' => 'required|string',
            'dapAnA' => 'required|string',
            'dapAnB' => 'required|string',
            'dapAnC' => 'required|string',
            'dapAnD' => 'required|string',
            'dapAnDung' => 'required|in:A,B,C,D',
            'doKho' => 'required|in:Dễ,Trung bình,Khó',
            'maMonHoc' => 'required|exists:mon_hoc,maMH',
        ], [
            'required' => 'Trường :attribute không được để trống.',
            'in' => 'Trường :attribute không hợp lệ.',
            'exists' => 'Môn học không tồn tại.',
        ]);

        // Tạo mới câu hỏi
        $cauHoi = new CauHoi();
        $cauHoi->setNoiDung($request->input('noiDung'));
        $cauHoi->setA($request->input('dapAnA'));
        $cauHoi->setB($request->input('dapAnB'));
        $cauHoi->setC($request->input('dapAnC'));
        $cauHoi->setD($request->input('dapAnD'));
        $cauHoi->setDung($request->input('dapAnDung'));
        $cauHoi->setDoKho($request->input('doKho'));
        $cauHoi->setMaMonHoc($request->input('maMonHoc'));
        $cauHoi->setMaNguoiTao(auth()->user()->maTK);
        $cauHoi->setNgayTao(now());
        $cauHoi->save();

        return redirect()->route('cauhoi.index')->with('success', 'Thêm câu hỏi mới thành công!');
    }

    public function exportExcel()
    {
        try {
            return Excel::download(new CauHoiExport, 'cau_hoi_mau.xlsx');
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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new CauHoiImport, $request->file('file'));
            return back()->with('success', 'Import thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Import thất bại: ' . $e->getMessage());
        }
    }
}