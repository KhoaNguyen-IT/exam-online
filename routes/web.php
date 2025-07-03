<?php

use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\User\TaiKhoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\User\BaiLamController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\KetQuaThiController as ketQuaThiUser;
use App\Http\Controllers\User\DeThiController as deThiUser;
use App\Http\Controllers\KyThiController;
use App\Http\Controllers\KetQuaThiController;
use App\Http\Controllers\CauHoiController;
use App\Http\Controllers\DeThiController;
use App\Http\Controllers\TaiKhoanController as account;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', fn() => redirect()->route('getLogin'));
Route::get('/login', [AuthenticateController::class, 'getLogin'])->name('getLogin');
Route::post('/login', [AuthenticateController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticateController::class, 'logout'])->name('logout');

/*Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = TaiKhoan::findOrFail($id);

    if (! hash_equals(sha1($user->email), $hash)) {
        abort(403, 'Link xác minh không hợp lệ');
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    Auth::login($user);

    $controller = app(AuthenticateController::class);
    return $controller->checkVeryfiedEmail($user);
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $user = $request->user();

    if ($user->hasVerifiedEmail()) {
        $controller = app(AuthenticateController::class);
        return $controller->checkVeryfiedEmail($user);
    }

    $user->sendEmailVerificationNotification();

    return back()->with('verifyEmail', 'Đã gửi lại email xác minh. Vui lòng kiểm tra hộp thư!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');*/

Route::middleware(['auth', 'role:quanTri'])->group(function () {
    Route::get('/taikhoan', [account::class, 'index'])->name('taikhoan.index');
    Route::get('/taikhoan/create', [account::class, 'create'])->name('taikhoan.create');
    Route::post('/taikhoan/store', [account::class, 'addTaiKhoan'])->name('taikhoan.store');
    Route::get('/taikhoan/{id}', [account::class, 'show'])->name('taikhoan.show');

    Route::get('/adminProfile', [account::class, 'getProfileAdmin'])->name('admin.getProfileAdmin');
    Route::put('/updateAdminProfile/{id}', [account::class, 'updateProfile'])->name('admin.updateProfile');
});

Route::middleware(['auth', 'role:giangVien'])->group(function () {
    Route::get('/monhoc', [MonHocController::class, 'index'])->name('monhoc.index');
    Route::get('/monhoc/{id}/show', [MonHocController::class, 'show'])->name('monhoc.show');
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
    Route::get('/ky-thi/export-excel', [KyThiController::class, 'exportExcel'])->name('kythi.exportExcel');

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

    Route::get('/dethi', [DeThiController::class, 'index'])->name('dethi.index');
    Route::get('/dethi/{id}', [DeThiController::class, 'show'])->name('dethi.show');
    Route::get('/de-thi/create', [DeThiController::class, 'create'])->name('dethi.create');
    Route::post('/dethi/store', [DeThiController::class, 'addDeThi'])->name('dethi.store');
    Route::get('/dethi/{id}/edit', [DeThiController::class, 'edit'])->name('dethi.edit');
    Route::put('/dethi/{id}', [DeThiController::class, 'updateDeThi'])->name('dethi.update');

    Route::get('/teacherProfile', [account::class, 'getProfileTeacher'])->name('teacher.getProfileTeacher');
    Route::put('/updateTeacherProfile/{id}', [account::class, 'updateProfile'])->name('teacher.updateProfile');
});

Route::middleware(['auth', 'role:sinhVien'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home.index');
    Route::get('/about', function(){ return view('user.about'); })->name('user.about');

    Route::get('/examList', [deThiUser::class, 'index'])->name('user.examList.index');
    Route::get('/examList/filterId/{id}', [deThiUser::class, 'getKyThiByMaMH'])->name('user.examList.filterMaMH');
    Route::get('/examList/filterName', [deThiUser::class, 'getKyThiByTenMH'])->name('user.examList.filterTenMH');

    Route::get('/test/{id}', [BaiLamController::class, 'index'])->name('user.test.index');
    Route::post('/test/{id}', [BaiLamController::class, 'nopBai'])->name('user.test.nopBai');

    Route::get('/testHistory', [BaiLamController::class, 'getTestHistory'])->name('user.testHistory.getTestHistory');

    Route::get('/testDetail/{id}', [ketQuaThiUser::class, 'index'])->name('user.testDetail.index');
    Route::post('/testDetail/{id}', [ketQuaThiUser::class, 'guiNhanXet'])->name('user.testDetail.guiNhanXet');

    Route::get('/accountInfo', [TaiKhoanController::class, 'index'])->name('user.accountInfo.index');
    Route::put('/updateAccountInfo/{id}', [TaiKhoanController::class, 'update'])->name('user.accountInfo.update');
});
