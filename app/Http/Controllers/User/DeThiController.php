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
use Illuminate\Support\Str;

class DeThiController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $userId = Auth::user()->maTK;

        $monHocs = MonHoc::all();

        $deThis = DeThi::with(['kyThi', 'monHoc'])
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereDate('ngayThi', '<=', Carbon::now())
                    ->whereHas('quanLyThis', function ($q) use ($userId) {
                        $q->where('maTK', $userId);
                    });
            })
            ->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThi;

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->where('trangThai', 'Đã hoàn thành')
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra | Trắc nghiệm';
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
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereDate('ngayThi', '<=', Carbon::now())
                    ->whereHas('quanLyThis', function ($q) use ($userId) 
                    {
                        $q->where('maTK', $userId);
                    });
            })
            ->with(['kyThi', 'monHoc'])
            ->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThi;

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->where('trangThai', 'Đã hoàn thành')
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra | Trắc nghiệm';
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
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereDate('ngayThi', '<=', Carbon::now())
                    ->whereHas('quanLyThis', function ($q) use ($userId) 
                    {
                        $q->where('maTK', $userId);
                    });
            })
            ->with(['monHoc', 'kyThi'])
            ->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThi;

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->ngayThi = $kyThi->ngayThi;
                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->ngayThi = null;
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;

            $deThi->daLamBai = BaiLam::where('maDT', $deThi->maDT)
                ->where('maTK', $userId)
                ->where('trangThai', 'Đã hoàn thành')
                ->exists();
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra | Trắc nghiệm';
        $this->viewData['monHocs'] = $monHocs;
        $this->viewData['monHocSelected'] = $monHocSelected;
        $this->viewData['deThis'] = $deThis;

        return view('user.examList', ['viewData' => $this->viewData]);
    }
}
