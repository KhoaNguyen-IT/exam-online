<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\CauHoi;
use App\Models\MonHoc;
use App\Models\DeThi;
use App\Models\Chuong;
use App\Exports\CauHoiExport;
use App\Imports\CauHoiImport;
use Maatwebsite\Excel\Facades\Excel;

class CauHoiController extends Controller
{
    public $viewData = [];
    public function index(Request $request)
    {
        if ($request->has('maMH')) {
            $maMH = $request->query('maMH');
            $this->viewData['monHocChon'] = MonHoc::find($maMH);
            $this->viewData['cauHoi'] = CauHoi::where('maMonHoc', $maMH)->with(['taiKhoan', 'monHoc'])->get();
            $this->viewData['chuongList'] = Chuong::where('maMH', $maMH)->get();
            return view('cauHoi.dsTheoMon', ['viewData' => $this->viewData]);
        }

        $this->viewData['monHoc'] = MonHoc::all();
        return view('cauHoi.danhSachMonHoc', ['viewData' => $this->viewData]);
    }


    public function show($id)
    {
        $this->viewData['title'] = "Chi tiết câu hỏi";
        $this->viewData['chiTietCauHoi'] = CauHoi::findOrFail($id);
        return view('cauHoi.detail', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $chiTietCauHoi = CauHoi::findOrFail($id);
        $this->viewData['title'] = "Chỉnh sửa câu hỏi";
        $this->viewData['chiTietCauHoi'] = $chiTietCauHoi;

        $this->viewData['monHocChon'] = $chiTietCauHoi->getMaMonHoc();

        // Tất cả môn học
        $this->viewData['monHoc'] = MonHoc::all();

        $this->viewData['chuong'] = Chuong::select('maChuong', 'tenChuong', 'maMH')->get();

        return view('cauHoi.update', ['viewData' => $this->viewData]);
    }

    public function create(Request $request)
    {
        $maMH = $request->query('maMH');

        $this->viewData['title'] = "Thêm câu hỏi mới";
        $this->viewData['monHoc'] = MonHoc::all();
        $this->viewData['monHocChon'] = $maMH;
        $this->viewData['chuong'] = $maMH ? Chuong::where('maMH', $maMH)->get() : Chuong::all();

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
            'doKho' => 'required|in:Dễ,Trung Bình,Khó',
            'maChuong' => 'required|exists:chuong,maChuong',
        ], [
            'required' => 'Trường :attribute không được để trống.',
            'in' => 'Trường :attribute không hợp lệ.',
            'exists' => 'Chương không tồn tại.',
        ]);

        $cauHoi = CauHoi::findOrFail($id);

        //Kiểm tra trùng nội dung trong toàn bảng
        $isDuplicate = CauHoi::whereRaw('LOWER(TRIM(noiDung)) = ?', [strtolower(trim($request->input('noiDung')))])
            ->where('maCH', '!=', $id)
            ->exists();

        if ($isDuplicate) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nội dung câu hỏi đã tồn tại.');
        }

        // Cập nhật các trường của chi tiết câu hỏi
        $cauHoi->setNoiDung($request->input('noiDung'));
        $cauHoi->setA($request->input('dapAnA'));
        $cauHoi->setB($request->input('dapAnB'));
        $cauHoi->setC($request->input('dapAnC'));
        $cauHoi->setD($request->input('dapAnD'));
        $cauHoi->setDung($request->input('dapAnDung'));
        $cauHoi->setDoKho($request->input('doKho'));
        $cauHoi->setMaMonHoc($request->input('maMonHoc'));
        $cauHoi->setMaChuong($request->input('maChuong'));
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
            'maChuong' => 'required|exists:chuong,maChuong',
        ], [
            'required' => 'Trường :attribute không được để trống.',
            'in' => 'Trường :attribute không hợp lệ.',
            'exists' => 'Giá trị :attribute không tồn tại trong hệ thống.',
        ]);

        //Kiểm tra trùng nội dung
        $isDuplicate = CauHoi::whereRaw('LOWER(TRIM(noiDung)) = ?', [strtolower(trim($request->input('noiDung')))])->exists();

        if ($isDuplicate) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Câu hỏi với nội dung này đã tồn tại.');
        }

        $cauHoi = new CauHoi();
        $cauHoi->setNoiDung($request->input('noiDung'));
        $cauHoi->setA($request->input('dapAnA'));
        $cauHoi->setB($request->input('dapAnB'));
        $cauHoi->setC($request->input('dapAnC'));
        $cauHoi->setD($request->input('dapAnD'));
        $cauHoi->setDung($request->input('dapAnDung'));
        $cauHoi->setDoKho($request->input('doKho'));
        $cauHoi->setMaMonHoc($request->input('maMonHoc'));
        $cauHoi->setMaChuong($request->input('maChuong'));
        $cauHoi->setMaNguoiTao(auth()->user()->maTK);
        $cauHoi->setNgayTao(now());
        $cauHoi->save();

        return redirect()->route('cauhoi.index', ['maMH' => $request->input('maMonHoc')])
            ->with('success', 'Thêm câu hỏi mới thành công!');
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

        $maMH = $request->query('maMH');

        // Kiểm tra tồn tại mã môn học
        if (!$maMH || !MonHoc::where('maMH', $maMH)->exists()) {
            return back()->with('error', 'Mã môn học không hợp lệ hoặc không tồn tại.');
        }

        try {
            Excel::import(new CauHoiImport($maMH), $request->file('file'));
            return back()->with('success', 'Import thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Import thất bại: ' . $e->getMessage());
        }
    }
}