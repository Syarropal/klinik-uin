<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

// ========================
// ROUTE PUBLIK (TANPA LOGIN)
// ========================

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);


// ========================
// SEMUA HALAMAN BUTUH LOGIN
// ========================

Route::middleware(['auth'])->group(function () {

    // --- ADMIN ---
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('pasien', PasienController::class);
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');

    // --- DOKTER ---
    Route::get('/dokter/dashboard', function () {
        return view('dokter.dashboard');
    });
    Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
    Route::post('/resep', [ResepController::class, 'store'])->name('resep.store');
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');

    // --- APOTEKER ---
    Route::get('/apoteker', [ApotekerController::class, 'index'])->name('apoteker.index');
    Route::post('/apoteker', [ApotekerController::class, 'store'])->name('apoteker.store');

});