<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\ChiTietDeThi;
use App\Models\MonHoc;
use App\Models\CauHoi;
use App\Models\TaiKhoan;
use App\Models\Chuong;

class DeThiController extends Controller
{
    public $viewData = [];
    public function index(Request $request)
    {
        if ($request->has('maTK')) {
            $maTK = $request->query('maTK');
            $this->viewData['giangVien'] = TaiKhoan::findOrFail($maTK);
            $this->viewData['deThi'] = DeThi::where('maTK', $maTK)->with('monHoc')->get();
            return view('deThi.dsTheoGiangVien', ['viewData' => $this->viewData]);
        }

        $this->viewData['giangVienList'] = TaiKhoan::where('vaiTro', 'giangVien')->get();
        return view('deThi.dsGiangVien', ['viewData' => $this->viewData]);
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
        $this->viewData['chuong'] = Chuong::all();
        return view('deThi.create', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $deThi = DeThi::findOrFail($id);

        $this->viewData['title'] = "Chỉnh sửa đề thi";
        $this->viewData['deThi'] = $deThi;
        $this->viewData['monHoc'] = MonHoc::all();

        $this->viewData['cauHoiTrongDe'] = ChiTietDeThi::where('maDT', $id)->with('cauHoi')->get();

        return view('dethi.update', ['viewData' => $this->viewData]);
    }


    public function addDeThi(Request $request)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'soLuong' => 'required|integer|min:1',
            'chuong_ids' => 'required|array|min:1',
            'chuong_ids.*' => 'exists:chuong,maChuong',
        ]);

        // Lấy số câu hỏi từ các chương đã chọn
        $tongCauHoi = CauHoi::whereIn('maChuong', $request->chuong_ids)->get();

        if ($tongCauHoi->count() < $request->soLuong) {
            return back()->withInput()->withErrors([
                'soLuong' => 'Không đủ câu hỏi để tạo đề thi. Chỉ có ' . $tongCauHoi->count() . ' câu hỏi trong các chương đã chọn.',
            ]);
        }

        // Nếu đủ, tạo đề thi
        $deThi = new DeThi();
        $deThi->tenDT = $request->tenDT;
        $deThi->maMH = $request->monHoc;
        $deThi->thoiLuongPhut = $request->thoiLuong;
        $deThi->moTa = $request->moTa ?? '';
        $deThi->maTK = auth()->user()->maTK;
        $deThi->ngayTao = now();
        $deThi->save();

        // Random câu hỏi trong danh sách đã đủ
        $randomCauHoi = $tongCauHoi->shuffle()->take($request->soLuong);

        foreach ($randomCauHoi as $cauHoi) {
            ChiTietDeThi::create([
                'maDT' => $deThi->maDT,
                'maCH' => $cauHoi->maCH,
            ]);
        }

        return redirect()->route('dethi.index', ['maTK' => $deThi->maTK])->with('success', 'Tạo đề thi thành công!');
    }

    public function updateDeThi(Request $request, $id)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'thoiLuong' => 'required|integer|min:1',
            'chuong_ids' => 'required|array|min:1',
            'chuong_ids.*' => 'exists:chuong,maChuong',
            'soLuong' => 'required|integer|min:1',
        ]);

        $deThi = DeThi::findOrFail($id);

        $deThi->tenDT = $request->tenDT;
        $deThi->maMH = $request->monHoc;
        $deThi->thoiLuongPhut = $request->thoiLuong;
        $deThi->moTa = $request->moTa ?? '';
        $deThi->save();

        // Xoá toàn bộ câu hỏi cũ
        ChiTietDeThi::where('maDT', $id)->delete();

        // Lấy lại số lượng câu hỏi theo chương và random
        $soLuong = $request->soLuong;
        $cauHoiMoi = CauHoi::whereIn('maChuong', $request->chuong_ids)
            ->inRandomOrder()
            ->limit($soLuong)
            ->get();

        foreach ($cauHoiMoi as $cauHoi) {
            ChiTietDeThi::create([
                'maDT' => $deThi->maDT,
                'maCH' => $cauHoi->maCH,
            ]);
        }

        return redirect()->route('dethi.index', ['maTK' => $deThi->maTK])->with('success', 'Cập nhật đề thi thành công!');
    }
}
