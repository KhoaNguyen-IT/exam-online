<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/monhoc', [MonHocController::class, 'index'])->name('monhoc.index');
Route::get('/monhoc/{id}/edit', [MonHocController::class, 'edit'])->name('monhoc.edit');
Route::put('/monhoc/{id}', [MonHocController::class, 'updateMonHoc'])->name('monhoc.update');
Route::get('/monhoc/create', [MonHocController::class, 'create'])->name('monhoc.create');
Route::post('/monhoc', [MonHocController::class, 'addMonhoc'])->name('monhoc.store');