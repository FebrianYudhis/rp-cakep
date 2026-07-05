<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/app/terkunci', [AppController::class, 'terkunci'])->middleware('kunciapp')->name('user.terkunci');

Route::prefix('app')->middleware(['kunciapp', 'cekakun'])->name('user.')->group(function () {
    Route::get('/', [AppController::class, 'index'])->name('dashboard');

    Route::get('/ganti-password', [AppController::class, 'gantipassword'])->name('gantipassword');
    Route::post('/ganti-password', [AppController::class, 'gantipasswordpost']);

    Route::name('presensi.')->group(function () {
        Route::get('/presensi-datang', [AppController::class, 'presensidatang'])->name('datang');
        Route::put('/presensi-datang', [AppController::class, 'catatpresensidatang']);

        Route::get('/presensi-pulang', [AppController::class, 'presensipulang'])->name('pulang');
        Route::put('/presensi-pulang', [AppController::class, 'catatpresensipulang']);
    });
});
