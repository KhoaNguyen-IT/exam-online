<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\ChiTietDeThi;
use App\Models\MonHoc;
use App\Models\CauHoi;
use App\Models\TaiKhoan;
use App\Models\Chuong;
use Illuminate\Support\MessageBag;

class DeThiController extends Controller
{
    public $viewData = [];
    public function index()
    {
        $giangVien = auth()->user();

        if ($giangVien->vaiTro !== 'giangVien') {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $this->viewData['title'] = 'Danh sách đề thi của bạn';
        $this->viewData['giangVien'] = $giangVien;
        $this->viewData['deThi'] = DeThi::where('maTK', $giangVien->maTK)->with('monHoc')->get();

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
        $this->viewData['chuong'] = Chuong::all();
        return view('deThi.create', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $deThi = DeThi::findOrFail($id);

        $this->viewData['title'] = "Chỉnh sửa đề thi";
        $this->viewData['deThi'] = $deThi;
        $this->viewData['monHoc'] = MonHoc::all();
        $this->viewData['chuong'] = Chuong::all();

        $cauHoiTrongDe = ChiTietDeThi::where('maDT', $id)->with('cauHoi')->get();
        $this->viewData['cauHoiTrongDe'] = $cauHoiTrongDe;

        // Dựng lại ma trận từ các câu hỏi trong đề
        $matrix = [];
        foreach ($cauHoiTrongDe as $ct) {
            $cauHoi = $ct->cauHoi;
            $chuongID = $cauHoi->maChuong;
            $doKho = $cauHoi->doKho;

            $key = match ($doKho) {
                'Dễ' => 'de',
                'Trung Bình' => 'trung_binh',
                'Khó' => 'kho',
                default => null,
            };

            if ($key) {
                $matrix[$chuongID][$key] = ($matrix[$chuongID][$key] ?? 0) + 1;
            }
        }

        $this->viewData['matrix'] = $matrix;

        return view('dethi.update', ['viewData' => $this->viewData]);
    }

    public function addDeThi(Request $request)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'thoiLuong' => 'required|integer|min:1',
            'soLuong' => 'required|integer|min:1',
            'matrix' => 'required|array|min:1',
        ]);

        $matrix = $request->input('matrix');
        $tongYeuCau = 0;
        $tongCauHoiLayDuoc = 0;
        $loiChiTiet = [];

        // Tạo đề thi trước nhưng chưa lưu nếu có lỗi
        $deThiData = [
            'tenDT' => $request->tenDT,
            'maMH' => $request->monHoc,
            'thoiLuongPhut' => $request->thoiLuong,
            'moTa' => $request->moTa ?? '',
            'maTK' => auth()->user()->maTK,
            'ngayTao' => now(),
        ];

        // Duyệt từng chương và độ khó
        foreach ($matrix as $chuongID => $levels) {
            foreach (['de' => 'Dễ', 'trung_binh' => 'Trung Bình', 'kho' => 'Khó'] as $key => $label) {
                $soLuongYeuCau = isset($levels[$key]) ? (int) $levels[$key] : 0;
                $tongYeuCau += $soLuongYeuCau;

                if ($soLuongYeuCau > 0) {
                    $questions = CauHoi::where('maChuong', $chuongID)
                        ->where('doKho', $label)
                        ->take($soLuongYeuCau)
                        ->get();

                    $layDuoc = $questions->count();
                    $tongCauHoiLayDuoc += $layDuoc;

                    if ($layDuoc < $soLuongYeuCau) {
                        $tenChuong = optional(Chuong::find($chuongID))->tenChuong ?? "Chương ID $chuongID";
                        $loiChiTiet[] = "Không đủ câu hỏi mức độ <strong>$label</strong> trong <strong>$tenChuong</strong> (yêu cầu $soLuongYeuCau, có $layDuoc).";
                    }
                }
            }
        }

        // Nếu có lỗi chi tiết về chương
        if (count($loiChiTiet)) {
            return back()->withInput()->withErrors([
                'matrix' => 'Có lỗi trong việc chọn câu hỏi: <ul><li>' . implode('</li><li>', $loiChiTiet) . '</li></ul>',
            ]);
        }

        // Nếu tổng số câu lấy được khác số lượng yêu cầu
        if ($tongCauHoiLayDuoc != $request->soLuong) {
            return back()->withInput()->withErrors([
                'soLuong' => "Tổng số câu hỏi lấy được ($tongCauHoiLayDuoc) không khớp với số câu hỏi bạn đã nhập ({$request->soLuong}).",
            ]);
        }

        // Lưu đề thi
        $deThi = DeThi::create($deThiData);

        // Gán chi tiết đề thi
        foreach ($matrix as $chuongID => $levels) {
            foreach (['de' => 'Dễ', 'trung_binh' => 'Trung Bình', 'kho' => 'Khó'] as $key => $label) {
                $soLuongYeuCau = isset($levels[$key]) ? (int) $levels[$key] : 0;

                if ($soLuongYeuCau > 0) {
                    $questions = CauHoi::where('maChuong', $chuongID)
                        ->where('doKho', $label)
                        ->inRandomOrder()
                        ->take($soLuongYeuCau)
                        ->get();

                    foreach ($questions as $q) {
                        ChiTietDeThi::create([
                            'maDT' => $deThi->maDT,
                            'maCH' => $q->maCH,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('dethi.index')->with('success', 'Tạo đề thi thành công!');
    }

    public function updateDeThi(Request $request, $id)
    {
        $request->validate([
            'tenDT' => 'required|string|max:255',
            'monHoc' => 'required|exists:mon_hoc,maMH',
            'thoiLuong' => 'required|integer|min:1',
            'soLuong' => 'required|integer|min:1',
            'matrix' => 'required|array|min:1',
        ]);

        $matrix = $request->input('matrix');
        $tongYeuCau = 0;
        $errors = new MessageBag();

        foreach ($matrix as $chuongID => $levels) {
            foreach (['de' => 'Dễ', 'trung_binh' => 'Trung Bình', 'kho' => 'Khó'] as $key => $label) {
                $yeuCau = (int) ($levels[$key] ?? 0);
                if ($yeuCau > 0) {
                    $soLuongCo = CauHoi::where('maChuong', $chuongID)
                        ->where('doKho', $label)
                        ->count();

                    if ($soLuongCo < $yeuCau) {
                        $tenChuong = Chuong::find($chuongID)?->tenChuong ?? "Chương ID $chuongID";
                        $errors->add('matrix', "Không đủ câu hỏi mức độ <strong>$label</strong> trong <strong>$tenChuong</strong> (yêu cầu $yeuCau, có $soLuongCo).");
                    }

                    $tongYeuCau += $yeuCau;
                }
            }
        }

        if ($tongYeuCau != $request->soLuong) {
            $errors->add('soLuong', "Tổng số câu hỏi trong ma trận là <strong>$tongYeuCau</strong>, không khớp với số lượng câu hỏi đã nhập là <strong>{$request->soLuong}</strong>.");
        }

        if ($errors->any()) {
            return back()->withErrors($errors)->withInput();
        }

        // --- Cập nhật đề thi ---
        $deThi = DeThi::findOrFail($id);
        $deThi->tenDT = $request->tenDT;
        $deThi->maMH = $request->monHoc;
        $deThi->thoiLuongPhut = $request->thoiLuong;
        $deThi->moTa = $request->moTa ?? '';
        $deThi->save();

        ChiTietDeThi::where('maDT', $id)->delete();

        foreach ($matrix as $chuongID => $levels) {
            foreach (['de' => 'Dễ', 'trung_binh' => 'Trung Bình', 'kho' => 'Khó'] as $key => $label) {
                $count = (int) ($levels[$key] ?? 0);
                if ($count > 0) {
                    $questions = CauHoi::where('maChuong', $chuongID)
                        ->where('doKho', $label)
                        ->inRandomOrder()
                        ->take($count)
                        ->get();

                    foreach ($questions as $q) {
                        ChiTietDeThi::create([
                            'maDT' => $deThi->maDT,
                            'maCH' => $q->maCH,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('dethi.edit', $id)->with('success', 'Cập nhật đề thi thành công!');
    }
}
