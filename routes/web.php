<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\KyThiController;

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