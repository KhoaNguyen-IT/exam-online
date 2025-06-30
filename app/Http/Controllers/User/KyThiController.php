<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BaiLam;
use App\Models\DeThi;
use App\Models\KyThi;
use App\Models\MonHoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KyThiController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $userId = Auth::user()->maTK;

        $monHocs = MonHoc::all();

        $deThis = DeThi::with(['kyThis', 'monHoc'])->has('kyThis')->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThis->first();

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->maKT = $kyThi->maKT;
                $deThi->tenKT = $kyThi->tenKT;
                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->maKT = '';
                $deThi->tenKT = '';
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra';
        $this->viewData['monHocs'] = $monHocs;
        $this->viewData['deThis'] = $deThis;

        return view('user.examList', ['viewData' => $this->viewData]);
    }

    public function getKyThiByMaMH(Request $request, $id)
    {
        $userId = Auth::user()->maTK;

        $monHocs = MonHoc::all();

        $monHocSelected = MonHoc::where('maMH', $id)->value('tenMH');

        $deThis = DeThi::where('maMH', $id)
            ->has('kyThis')
            ->with(['kyThis', 'monHoc'])
            ->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThis->first();

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->maKT = $kyThi->maKT;
                $deThi->tenKT = $kyThi->tenKT;
                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->maKT = '';
                $deThi->tenKT = '';
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra';
        $this->viewData['monHocs'] = $monHocs;
        $this->viewData['monHocSelected'] = $monHocSelected;
        $this->viewData['deThis'] = $deThis;

        return view('user.examList', ['viewData' => $this->viewData]);
    }


    public function getKyThiByTenMH(Request $request)
    {
        $userId = Auth::user()->maTK;

        $tenMH = $request->kyThiTheoTenMonHoc;

        $monHocs = MonHoc::all();

        $monHoc = MonHoc::whereRaw('LOWER(tenMH) = ?', [Str::lower($tenMH)])->first();

        if (!$monHoc) {
            return redirect()->back()->with('notFoundTenMH', 'Môn học bạn cần tìm không tồn tại trong hệ thống!');
        }

        $monHocSelected = $monHoc->tenMH;

        $deThis = DeThi::where('maMH', $monHoc->maMH)
            ->has('kyThis')
            ->with(['monHoc', 'kyThis'])
            ->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThis->first();

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->maKT = $kyThi->maKT;
                $deThi->tenKT = $kyThi->tenKT;
                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->maKT = '';
                $deThi->tenKT = '';
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra';
        $this->viewData['monHocs'] = $monHocs;
        $this->viewData['monHocSelected'] = $monHocSelected;
        $this->viewData['deThis'] = $deThis;

        return view('user.examList', ['viewData' => $this->viewData]);
    }
}
