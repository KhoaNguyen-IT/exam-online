<?php

use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\User\TaiKhoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\User\BaiLamController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\KetQuaThiController;
use App\Http\Controllers\User\KyThiController;

Route::get('/', fn() => redirect()->route('getLogin'));
Route::get('/login', [AuthenticateController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [AuthenticateController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:quanTri'])->group(function () {});

Route::middleware(['auth', 'role:giangVien'])->group(function () {
    Route::get('/monhoc', [MonHocController::class, 'index'])->name('monhoc.index');
    Route::get('/monhoc/{id}/edit', [MonHocController::class, 'edit'])->name('monhoc.edit');
    Route::put('/monhoc/{id}', [MonHocController::class, 'updateMonHoc'])->name('monhoc.update');
    Route::get('/monhoc/create', [MonHocController::class, 'create'])->name('monhoc.create');
    Route::post('/monhoc', [MonHocController::class, 'addMonhoc'])->name('monhoc.store');
});

Route::middleware(['auth', 'role:sinhVien'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home.index');

    Route::get('/examList', [KyThiController::class, 'index'])->name('user.examList.index');
    Route::get('/examList/filterId/{id}', [KyThiController::class, 'getKyThiByMaMH'])->name('user.examList.filterMaMH');
    Route::get('/examList/filterName', [KyThiController::class, 'getKyThiByTenMH'])->name('user.examList.filterTenMH');

    Route::get('/test/{id}', [BaiLamController::class, 'index'])->name('user.test.index');
    Route::post('/test/{id}', [BaiLamController::class, 'nopBai'])->name('user.test.nopBai');

    Route::get('/testHistory', [BaiLamController::class, 'getTestHistory'])->name('user.testHistory.getTestHistory');

    Route::get('/testDetail/{id}', [KetQuaThiController::class, 'index'])->name('user.testDetail.index');
    Route::post('/testDetail/{id}', [KetQuaThiController::class, 'guiNhanXet'])->name('user.testDetail.guiNhanXet');

    Route::get('/accountInfo', [TaiKhoanController::class, 'index'])->name('user.accountInfo.index');
    Route::put('/updateAccountInfo/{id}', [TaiKhoanController::class, 'update'])->name('user.accountInfo.update');
});
