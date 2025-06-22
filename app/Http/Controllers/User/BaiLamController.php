<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BaiLam;
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
        $this->viewData['title'] = 'Trang bài làm';
        $this->viewData['baiLam'] = DeThi::with(['monHoc', 'cauHois', 'kyThis'])->where('maDT', $id)->firstOrFail();

        return view('user.test', ['viewData' => $this->viewData]);
    }

    public function nopBai(Request $request, string $id)
    {
        $answers = $request->input('question');

        $ngayThiKetQuaThi = Carbon::parse($request->input('ngayThiKetQuaThi'));

        $userId = Auth::user()->maTK;

        $deThi = DeThi::with('cauHois')->where('maDT', $id)->firstOrFail();

        $tongSoCauHoi = $deThi->cauHois->count();

        $soCauDung = 0;

        $cauHoiMap = $deThi->cauHois->keyBy('maCH');

        if(!empty($answers))
        {
            foreach ($answers as $maCH => $dapAn) {
                $cauHoi = $cauHoiMap->get($maCH);

                if ($cauHoi && $cauHoi->dapAnDung === $dapAn) {
                    $soCauDung++;
                }
            }
        }

        $diem = ($tongSoCauHoi > 0) ? round((10 / $tongSoCauHoi) * $soCauDung, 2) : 0.00;

        $ketQuaThi = KetQuaThi::create([
            'maTK' => $userId,
            'maDT' => $id,
            'diemSo' => $diem,
            'tongSoCau' => $tongSoCauHoi,
            'soCauDung' => $soCauDung,
            'ngayThi' => $ngayThiKetQuaThi,
        ]);

        $maKetQuaThi = $ketQuaThi->maKQT;

        foreach ($deThi->cauHois as $cauHoi) {
            $maCH = $cauHoi->maCH;
            $dapAn = $answers[$maCH] ?? null;

            BaiLam::create([
                'maDT'       => $id,
                'maCH'       => $maCH,
                'maTK'       => $userId,
                'maKQT'      => $maKetQuaThi,
                'dapAnChon'  => $dapAn
            ]);
        }

        $thoiGianKetThucKyThi = $ngayThiKetQuaThi->copy()->addMinutes($deThi->thoiLuongPhut);

        if(now()->gt($thoiGianKetThucKyThi))
        {
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

    public function getTestHistory()
    {
        $this->viewData['title'] = 'Trang lịch sử bài làm';
        $this->viewData['danhSachMonHoc'] = MonHoc::all();
        $ketQuaThis = KetQuaThi::with(['deThi.monHoc', 'deThi.kyThis'])->paginate(4);

        foreach ($ketQuaThis as $kqt) {
            $kyThi = $kqt->deThi->kyThis->first();
            $thoiLuong = $kqt->deThi->thoiLuongPhut;

            if ($kyThi && $thoiLuong) {
                $ngayThi = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $ngayThi->copy()->addMinutes($thoiLuong);

                $kqt->daKetThuc = now()->greaterThan($thoiGianKetThuc);
            } else {
                $kqt->daKetThuc = null;
            }
        }

        $this->viewData['danhSachBaiLam'] = $ketQuaThis;

        return view('user.testHistory', ['viewData' => $this->viewData]);
    }
}
