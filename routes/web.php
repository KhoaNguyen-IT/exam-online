<?php

use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\User\TaiKhoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\KyThiController;
use App\Http\Controllers\KetQuaThiController;
use App\Http\Controllers\CauHoiController;

Route::get('/', [AuthenticateController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [AuthenticateController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');

Route::middleware(['auth.admin'])->group(function () {});

Route::middleware(['auth.teacher'])->group(function () {
   Route::get('/monhoc', [MonHocController::class, 'index'])->name('monhoc.index');
Route::get('/monhoc/{id}/edit', [MonHocController::class, 'edit'])->name('monhoc.edit');
Route::put('/monhoc/{id}', [MonHocController::class, 'updateMonHoc'])->name('monhoc.update');
Route::get('/monhoc/create', [MonHocController::class, 'create'])->name('monhoc.create');
Route::post('/monhoc', [MonHocController::class, 'addMonhoc'])->name('monhoc.store');

Route::get('/kythi', [KyThiController::class, 'index'])->name('kythi.index');
Route::get('/kythi/create', [KyThiController::class, 'create'])->name('kythi.create');
Route::post('/kythi', [KyThiController::class, 'addKyThi'])->name('kythi.store');
Route::get('/kythi/{id}', [KyThiController::class, 'show'])->name('kythi.show');
Route::get('/kythi/{id}/edit', [KyThiController::class, 'edit'])->name('kythi.edit');
Route::put('/kythi/{id}', [KyThiController::class, 'updateKyThi'])->name('kythi.update');

Route::get('/ketquathi', [KetQuaThiController::class, 'index'])->name('ketquathi.index');
Route::get('/ket-qua-thi/export-excel', [KetQuaThiController::class, 'exportExcel'])->name('ketQuaThi.exportExcel');

Route::get('/cauhoi', [CauHoiController::class, 'index'])->name('cauhoi.index');
Route::get('/cauhoi/create', [CauHoiController::class, 'create'])->name('cauhoi.create');
Route::post('/cauhoi/store', [CauHoiController::class, 'addCauHoi'])->name('cauhoi.store');
Route::get('/cauhoi/{id}/edit', [CauHoiController::class, 'edit'])->name('cauhoi.edit');
Route::put('/cauhoi/{id}', [CauHoiController::class, 'updateCauHoi'])->name('cauhoi.update');
Route::get('/cauhoi/{id}', [CauHoiController::class, 'show'])->name('cauhoi.show');
Route::get('/cau-hoi/export-excel', [CauHoiController::class, 'exportExcel'])->name('cauhoi.exportExcel');
Route::post('/cau-hoi/import-excel', [CauHoiController::class, 'importExcel'])->name('cauhoi.importExcel');
});

Route::middleware(['auth.student'])->group(function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::get('/examList', function () {
        return view('user.examList');
    })->name('user.examList');

    Route::get('/test', function () {
        return view('user.test');
    })->name('user.test');

    Route::get('/testHistory', function () {
        return view('user.testHistory');
    })->name('user.testHistory');

    Route::get('/testDetail', function () {
        return view('user.testDetail');
    })->name('user.testDetail');

    Route::get('/accountInfo', [TaiKhoanController::class, 'index'])->name('user.accountInfo.index');
    Route::put('/updateAccountInfo/{id}', [TaiKhoanController::class, 'update'])->name('user.accountInfo.update');
});
