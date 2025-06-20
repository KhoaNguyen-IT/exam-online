<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\KyThiController;
use App\Http\Controllers\KetQuaThiController;
use App\Http\Controllers\CauHoiController;

Route::get('/', function () {
    return view('welcome');
});

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