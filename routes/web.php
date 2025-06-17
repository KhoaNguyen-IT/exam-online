<?php

use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\User\TaiKhoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticateController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [AuthenticateController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');

Route::middleware(['auth.admin'])->group(function () {});

Route::middleware(['auth.teacher'])->group(function () {});

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