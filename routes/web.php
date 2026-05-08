<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes - SIMA (Sistem Informasi Mahasiswa)
|--------------------------------------------------------------------------
*/

// --- GRUP ROUTE UNTUK GUEST (Belum Login) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

    // Register
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

    // Verifikasi Email
    Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');
});

// --- GRUP ROUTE UNTUK AUTH (Sudah Login) ---
Route::middleware('auth')->group(function () {

    /**
     * PERBAIKAN DI SINI:
     * Mengarahkan 'home' ke MahasiswaController agar variabel $mahasiswa terdefinisi
     */
    Route::get('home', [MahasiswaController::class, 'index'])->name('home');

    // Management Mahasiswa
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('mahasiswa/simpan', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

    // Proses Logout
    Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');
});
