<?php

namespace App\Http\Controllers\User;

use App\Models\BaiLam;
use App\Models\ChiTietBaiLam;
use App\Models\DeThi;
use App\Models\KetQuaThi;
use App\Models\MonHoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaiLamController extends Controller
{
    public $viewData = [];

    public function index(string $id)
    {
        $this->viewData['title'] = 'Trang bài làm | Trắc nghiệm';

        $maTK = Auth::user()->maTK;

        $deThi = DeThi::with(['monHoc', 'cauHois', 'kyThi'])->where('maDT', $id)->firstOrFail();

        $checkBaiLam = BaiLam::where('maDT', $deThi->maDT)
            ->where('maTK', $maTK)
            ->first();

        if(!$checkBaiLam)
        {
            $baiLam = BaiLam::create([
                'maDT' => $deThi->maDT,
                'maTK' => $maTK,
                'maKQT' => null,
            ]);

            $this->doiThuTuCauHoiVaDapAn($baiLam->maBL, $deThi);

            $chiTietBaiLam = BaiLam::with('chiTietBaiLams.cauHoi')
                ->findOrFail($baiLam->maBL)
                ->chiTietBaiLams
                ->sortBy('thuTuCauHoi');

            $this->viewData['deThi'] = $deThi;
            $this->viewData['baiLam'] = $baiLam;
            $this->viewData['chiTietBaiLams'] = $chiTietBaiLam;

            return view('user.test', ['viewData' => $this->viewData]);
        }

        $chiTietBaiLam = BaiLam::with('chiTietBaiLams.cauHoi')
            ->findOrFail($checkBaiLam->maBL)
            ->chiTietBaiLams
            ->sortBy('thuTuCauHoi');

        $this->viewData['deThi'] = $deThi;
        $this->viewData['baiLam'] = $checkBaiLam;
        $this->viewData['chiTietBaiLams'] = $chiTietBaiLam;

        return view('user.test', ['viewData' => $this->viewData]);
    }

    public function nopBai(Request $request, string $id)
    {
        $maBL = $request->input('maBaiLam');

        $baiLam = BaiLam::where('maBL', $maBL)
            ->where('trangThai', 'Chưa hoàn thành')
            ->first();

        if ($baiLam) {
            $userId = Auth::user()->maTK;

            $deThi = DeThi::with('cauHois')->where('maDT', $id)->firstOrFail();

            $answers = $request->input('question');

            if (!empty($answers)) {
                foreach ($deThi->cauHois as $cauHoi) {
                    $maCH = $cauHoi->maCH;
                    $dapAnChon = $answers[$maCH] ?? null;

                    ChiTietBaiLam::where('maBL', $maBL)
                        ->where('maCH', $maCH)
                        ->update(['dapAnChon' => $dapAnChon]);
                }
            }

            $ngayThiKetQuaThi = Carbon::parse($request->input('ngayThiKetQuaThi'));

            $tongSoCauHoi = $deThi->cauHois->count();

            $soCauDung = 0;

            $cauHoiMap = $deThi->cauHois->keyBy('maCH');

            if (!empty($answers)) {
                foreach ($answers as $maCH => $dapAn) {
                    $cauHoi = $cauHoiMap->get($maCH);

                    if ($cauHoi && $cauHoi->dapAnDung === $dapAn) {
                        $soCauDung++;
                    }
                }
            }

            $diem = ($tongSoCauHoi > 0) ? round((10 / $tongSoCauHoi) * $soCauDung, 2) : 0;

            $ketQuaThi = KetQuaThi::create([
                'maTK' => $userId,
                'maDT' => $id,
                'diemSo' => $diem,
                'tongSoCau' => $tongSoCauHoi,
                'soCauDung' => $soCauDung,
                'ngayThi' => $ngayThiKetQuaThi,
            ]);

            $maKetQuaThi = $ketQuaThi->maKQT;

            $baiLam->maKQT = $maKetQuaThi;
            $baiLam->trangThai = 'Đã hoàn thành';
            $baiLam->save();

            $thoiGianKetThucKyThi = $ngayThiKetQuaThi->copy()->addMinutes($deThi->thoiLuongPhut);

            if (now()->gt($thoiGianKetThucKyThi)) {
                return back()->with([
                    'nopBaiThanhCongVaXemKetQua' => 'Bài làm của bạn đã được lưu vào hệ thống',
                    'maKQT' => $maKetQuaThi
                ]);
            } 
            else 
            {
                return back()->with('nopBaiThanhCong', 'Bài làm của bạn đã được lưu vào hệ thống');
            }
        }

        return back()->with('daHoanThanhBaiThi', 'Bài thi này đã được bạn hoàn thành');
    }

    public function getTestHistory()
    {
        $this->viewData['title'] = 'Trang lịch sử bài làm | Trắc nghiệm';

        $userId = Auth::user()->maTK;

        $baiLams = BaiLam::with(['deThi.monHoc', 'deThi.kyThi', 'ketQuaThi'])->where('maTK', $userId)->where('trangThai', 'Đã hoàn thành')->orderByDesc('updated_at')->paginate(4);

        foreach ($baiLams as $kqt) {
            $kyThi = $kqt->deThi->kyThi;
            $thoiLuong = $kqt->deThi->thoiLuongPhut;

            if ($kyThi && $thoiLuong) {
                $ngayThi = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $ngayThi->copy()->addMinutes($thoiLuong);

                $kqt->daKetThuc = now()->greaterThan($thoiGianKetThuc);
            } else {
                $kqt->daKetThuc = null;
            }
        }

        $this->viewData['baiLams'] = $baiLams;

        return view('user.testHistory', ['viewData' => $this->viewData]);
    }

    public function doiThuTuCauHoiVaDapAn($maBL, $deThi)
    {
        $cauHois = $deThi->cauHois->toArray();

        $n = count($cauHois);

        for ($i = $n - 1; $i > 0; $i--)
        {
            $j = rand(0, $i);

            $this->hoanVi($cauHois[$i], $cauHois[$j]);
        }

        foreach ($cauHois as $index => $cauHoi)
        {
            $dapAns = [
                'A' => $cauHoi['dapAnA'],
                'B' => $cauHoi['dapAnB'],
                'C' => $cauHoi['dapAnC'],
                'D' => $cauHoi['dapAnD'],
            ];

            $dapAnKeys = array_keys($dapAns);
            $m = count($dapAnKeys);

            for ($i = $m - 1; $i > 0; $i--)
            {
                $j = rand(0, $i);

                $this->hoanVi($dapAnKeys[$i], $dapAnKeys[$j]);
            }

            $dapAnMap = [];

            foreach (['A', 'B', 'C', 'D'] as $pos => $hienThi) 
            {
                $dapAnMap[$hienThi] = $dapAnKeys[$pos];
            }

            ChiTietBaiLam::create([
                'maBL' => $maBL,
                'maCH' => $cauHoi['maCH'],
                'thuTuCauHoi' => $index + 1,
                'hienThiA' => $dapAnMap['A'],
                'hienThiB' => $dapAnMap['B'],
                'hienThiC' => $dapAnMap['C'],
                'hienThiD' => $dapAnMap['D'],
                'dapAnChon' => null,
            ]);
        }
    }

    public function hoanVi(&$a, &$b)
    {
        $temp = $a;
        $a = $b;
        $b = $temp;
    }
}
