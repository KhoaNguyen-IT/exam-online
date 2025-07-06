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

        $monHocs = MonHoc::whereHas('deThis.kyThi.quanLyThis', function ($q) use ($userId) {
            $q->where('maTK', $userId);
        })->get();

        $deThis = DeThi::with(['kyThi', 'monHoc'])
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereHas('quanLyThis', function ($q) use ($userId) {
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

        $monHocs = MonHoc::whereHas('deThis.kyThi.quanLyThis', function ($q) use ($userId) {
            $q->where('maTK', $userId);
        })->get();

        $monHocSelected = MonHoc::where('maMH', $id)->value('tenMH');

        $deThis = DeThi::where('maMH', $id)
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereHas('quanLyThis', function ($q) use ($userId) 
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

        $monHocs = MonHoc::whereHas('deThis.kyThi.quanLyThis', function ($q) use ($userId) {
            $q->where('maTK', $userId);
        })->get();

        $monHoc = $monHocs->first(function ($mh) use ($tenMH) {
            return Str::lower($mh->tenMH) === Str::lower($tenMH);
        });

        if (!$monHoc) {
            return redirect()->back()->with('notFoundTenMH', 'Môn học bạn cần tìm không tồn tại trong hệ thống hoặc bạn không được phép thi!');
        }

        $monHocSelected = $monHoc->tenMH;

        $deThis = DeThi::where('maMH', $monHoc->maMH)
            ->whereHas('kyThi', function ($query) use ($userId) {
                $query->whereHas('quanLyThis', function ($q) use ($userId) 
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

    public function getKyThiBySatus(string $status)
    {
        $userId = Auth::user()->maTK;
        $now = Carbon::now();
        $statusSelected = null;

        $monHocs = MonHoc::whereHas('deThis.kyThi.quanLyThis', function ($q) use ($userId) {
            $q->where('maTK', $userId);
        })->get();

        $deThisQuery = DeThi::whereHas('kyThi', function ($q) use ($userId) {
            $q->whereHas('quanLyThis', function ($q2) use ($userId) {
                $q2->where('maTK', $userId);
            });
        })
            ->with(['kyThi', 'monHoc', 'baiLams' => function ($q) use ($userId) {
                $q->where('maTK', $userId);
            }]);

        if ($status === 'da-mo') {
            $statusSelected = 'Đã mở';

            $deThisQuery->whereHas('kyThi', function ($q) use ($now) {
                $q->where('ngayThi', '<=', $now)
                    ->whereRaw('? BETWEEN ngayThi AND DATE_ADD(ngayThi, INTERVAL de_thi.thoiLuongPhut MINUTE)', [$now]);
            })
                ->whereDoesntHave('baiLams', function ($q) use ($userId) {
                    $q->where('maTK', $userId)
                        ->where('trangThai', 'Đã hoàn thành');
                });
        } elseif ($status === 'chua-mo') {
            $statusSelected = 'Chưa mở';
            $deThisQuery->whereHas('kyThi', function ($q) use ($now) {
                $q->where('ngayThi', '>', $now);
            });
        } elseif ($status === 'da-hoan-thanh') {
            $statusSelected = 'Đã hoàn thành';
            $deThisQuery->whereHas('baiLams', function ($q) use ($userId) {
                $q->where('maTK', $userId)
                    ->where('trangThai', 'Đã hoàn thành');
            });
        } elseif ($status === 'da-dong') {
            $statusSelected = 'Đã đóng';

            $deThisQuery->whereHas('kyThi', function ($q) use ($now) {
                $q->whereRaw('? > DATE_ADD(ngayThi, INTERVAL de_thi.thoiLuongPhut MINUTE)', [$now]);
            })->whereDoesntHave('baiLams', function ($q) use ($userId) {
                $q->where('maTK', $userId)
                    ->where('trangThai', 'Đã hoàn thành');
            });
        }

        $deThis = $deThisQuery->paginate(4);

        foreach ($deThis as $deThi) {
            $kyThi = $deThi->kyThi;

            if ($kyThi && $kyThi->ngayThi && $deThi->thoiLuongPhut) {
                $thoiGianBatDau = Carbon::parse($kyThi->ngayThi);
                $thoiGianKetThuc = $thoiGianBatDau->copy()->addMinutes($deThi->thoiLuongPhut);

                $deThi->thoiGianBatDau = $thoiGianBatDau;
                $deThi->thoiGianKetThuc = $thoiGianKetThuc;
            } else {
                $deThi->thoiGianBatDau = null;
                $deThi->thoiGianKetThuc = null;
            }

            $deThi->tenMH = $deThi->monHoc?->tenMH;
            $deThi->daLamBai = $deThi->baiLams->where('trangThai', 'Đã hoàn thành')->count() > 0;
        }

        $this->viewData['title'] = 'Trang bài thi kiểm tra | Trắc nghiệm';
        $this->viewData['monHocs'] = $monHocs;
        $this->viewData['statusSelected'] = $statusSelected;
        $this->viewData['deThis'] = $deThis;

        return view('user.examList', ['viewData' => $this->viewData]);
    }
}
