<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\KyThi;
use App\Models\DeThi;
use App\Models\TaiKhoan;
use App\Models\QuanLyThi;
use App\Models\MonHoc;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SinhVienImport;
use App\Exports\SinhVienExport;

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
        $this->viewData['deThi'] = DeThi::all();
        $this->viewData['sinhVienList'] = TaiKhoan::where('vaiTro', 'sinhVien')->get();
        $this->viewData['monHocList'] = MonHoc::all();
        return view('kyThi.create', ['viewData' => $this->viewData]);
    }

    public function show($id)
    {
        $kyThi = KyThi::findOrFail($id);

        $this->viewData['title'] = "Chi tiết Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;
        $this->viewData['deThiList'] = DeThi::where('maKT', $id)->get();

        return view('kyThi.detail', ['viewData' => $this->viewData]);
    }

    public function showKetQua($id)
    {
        $kyThi = KyThi::findOrFail($id);

        $this->viewData['title'] = "Kết quả Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;

        // Lấy danh sách sinh viên thuộc kỳ thi
        $ketQuaList = QuanLyThi::where('maKT', $id)->get();

        $this->viewData['sinhVienList'] = $ketQuaList;

        return view('ketQuaThi.dsSinhVien', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $kyThi = KyThi::findOrFail($id);
        $this->viewData['title'] = "Chỉnh sửa Kỳ thi";
        $this->viewData['kyThi'] = $kyThi;
        $this->viewData['deThi'] = DeThi::select('maDT', 'tenDT', 'maMH', 'maKT')->get();
        $this->viewData['monHocList'] = MonHoc::all();
        $this->viewData['deThiList'] = DeThi::where('maKT', $id)->pluck('maDT')->toArray();

        $this->viewData['sinhVienListSelected'] = QuanLyThi::where('maKT', $id)->pluck('maTK')->toArray();
        $this->viewData['sinhVienSelectedObjects'] = TaiKhoan::whereIn('maTK', $this->viewData['sinhVienListSelected'])->get();

        return view('kyThi.update', ['viewData' => $this->viewData]);
    }


    public function updateKyThi(Request $request, $id)
    {
        $kyThi = KyThi::findOrFail($id);
        $kyThi->setTenKT($request->input('tenKT'));
        $kyThi->setMoTa($request->input('moTa') ?? '');
        $kyThi->save();

        // Xóa maKT khỏi các đề thi hiện đang thuộc kỳ thi này
        DeThi::where('maKT', $kyThi->maKT)->update(['maKT' => null]);

        // Gán lại các đề thi được chọn
        foreach ($request->input('de_thi_ids', []) as $maDT) {
            DeThi::where('maDT', $maDT)->update(['maKT' => $kyThi->maKT]);
        }

        // Xoá sinh viên cũ
        QuanLyThi::where('maKT', $id)->delete();

        // Gán sinh viên mới
        foreach ($request->input('sinh_vien_ids', []) as $maTK) {
            QuanLyThi::create(['maKT' => $kyThi->maKT, 'maTK' => $maTK]);
        }

        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được cập nhật thành công.');
    }

    public function addKyThi(Request $request)
    {
        $request->validate([
            'tenKT' => 'required|string|max:255',
            'ngayThi' => 'required|date',
            'thoiGianThi' => 'required',
            'de_thi_ids' => 'required|array|min:1',
            'excel_file' => 'nullable|file|mimes:xlsx,xls',
        ]);

        $kyThi = new KyThi();
        $kyThi->setTenKT($request->input('tenKT'));
        $kyThi->setMoTa($request->input('moTa') ?? '');
        $kyThi->setNgayThi(\Carbon\Carbon::parse($request->ngayThi . ' ' . $request->thoiGianThi));
        $kyThi->save();

        foreach ($request->input('de_thi_ids', []) as $maDT) {
            DeThi::where('maDT', $maDT)->update([
                'maKT' => $kyThi->maKT
            ]);
        }

        if ($request->hasFile('excel_file')) {
            $import = new SinhVienImport();
            Excel::import($import, $request->file('excel_file'));

            $emails = $import->emails;

            if (empty($emails)) {
                return redirect()->back()->withInput()->with('import_error', 'File Excel không chứa email nào hợp lệ.');
            }

            // Truy vấn tài khoản sinh viên tương ứng
            $taiKhoans = TaiKhoan::whereIn('email', $emails)
                ->where('vaiTro', 'sinhVien')
                ->get();

            $foundEmails = $taiKhoans->pluck('email')->toArray();
            $invalidEmails = array_diff($emails, $foundEmails);

            // Nếu có email không hợp lệ => trả về thông báo lỗi
            if (count($invalidEmails)) {
                return redirect()->back()
                    ->withInput()
                    ->with('import_error', 'Không tìm thấy sinh viên với các email: ' . implode(', ', $invalidEmails));
            }

            // Lưu danh sách sinh viên hợp lệ vào bảng quản lý thi
            foreach ($taiKhoans as $tk) {
                QuanLyThi::create([
                    'maKT' => $kyThi->maKT,
                    'maTK' => $tk->maTK
                ]);
            }
        }

        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được tạo thành công.');
    }

    public function exportExcel()
    {
        return Excel::download(new SinhVienExport(), 'sinh_vien.xlsx');
    }
}
