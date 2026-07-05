<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['kunciadmin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/ganti-password', [AdminController::class, 'gantipassword'])->name('gantipassword');
    Route::post('/ganti-password', [AdminController::class, 'gantipasswordpost']);

    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');

    Route::name('akun.')->group(function () {
        Route::patch('/akun/{user:username}/reset-masuk', [AdminController::class, 'resetmasuk'])->name('resetmasuk');
        Route::patch('/akun/{user:username}/aktifkan', [AdminController::class, 'aktifkanakun'])->name('aktifkan');
        Route::patch('/akun/{user:username}/matikan', [AdminController::class, 'matikanakun'])->name('matikan');
        Route::delete('/akun/{user:username}/hapus', [AdminController::class, 'hapusakun'])->name('hapus');
    });

    Route::get('/presensi', [AdminController::class, 'presensi'])->name('presensi');
    Route::get('/presensi/{presensi}/edit', [AdminController::class, 'editpresensi'])->name('presensi.edit');
    Route::put('/presensi/{presensi}/edit', [AdminController::class, 'updatepresensi']);

    Route::get('/formulir', [AdminController::class, 'formulir'])->name('formulir');
    Route::post('/formulir', [AdminController::class, 'generateformulir']);
});
