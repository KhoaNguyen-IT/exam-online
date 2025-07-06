<?php

namespace App\Providers;

use App\Models\DeThi;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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

        View::composer('*', function ($view) {
            if (!Auth::check() || !Auth::user()->maTK) {
                $view->with('deThiMoi', 0)->with('deThisMoiList', collect());
                return;
            }

            $user = Auth::user();

            $deThiQuery = DeThi::with('kyThi')
                ->whereHas('kyThi', function ($q) use ($user) {
                    $q->whereHas('quanLyThis', function ($q2) use ($user) {
                        $q2->where('maTK', $user->maTK);
                    });
                })
                ->whereDoesntHave('baiLams', function ($q) use ($user) {
                    $q->where('maTK', $user->maTK);
                });

            if ($user->last_seen_de_thi_at) {
                $deThiQuery->where('created_at', '>', $user->last_seen_de_thi_at);
            }

            $deThisMoiList = $deThiQuery->get();
            $deThiMoi = $deThisMoiList->count();

            $view->with('deThiMoi', $deThiMoi)
                ->with('deThisMoiList', $deThisMoiList);
        });
    }
}
