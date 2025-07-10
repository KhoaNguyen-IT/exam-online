<?php

namespace App\Providers;

use App\Models\DeThi;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $target = storage_path('app/public');
        $link = public_path('storage');
        if (!is_link($link)) {
            try {
                File::link($target, $link);
            } catch (\Exception $e) {
                Log::warning("Không thể tạo symlink 'storage': " . $e->getMessage());
            }
        }

        View::composer('*', function ($view) {
            if (!Auth::check() || !Auth::user()->maTK) {
                $view->with('deThiMoi', 0)->with('deThisMoiList', collect());
                return;
            }

            $user = Auth::user();
            $now = Carbon::now();

            $deThisMoiList = DeThi::with(['kyThi', 'monHoc'])
                ->whereHas('kyThi', function ($q) use ($user) {
                    $q->whereHas('quanLyThis', function ($q2) use ($user) {
                        $q2->where('maTK', $user->maTK);
                    });
                })
                ->whereHas('kyThi', function ($q) use ($now) {
                    $q->whereRaw("DATE_ADD(ngayThi, INTERVAL de_thi.thoiLuongPhut MINUTE) > ?", [$now]);
                })
                ->whereDoesntHave('baiLams', function ($q) use ($user) {
                    $q->where('maTK', $user->maTK);
                })
                ->get();

            $deThiMoi = 0;
            if ($user->last_seen_de_thi_at) {
                $deThiMoi = $deThisMoiList->where('created_at', '>', $user->last_seen_de_thi_at)->count();
            } else {
                $deThiMoi = $deThisMoiList->count();
            }

            $view->with('deThiMoi', $deThiMoi)
                ->with('deThisMoiList', $deThisMoiList);
        });
    }
}
