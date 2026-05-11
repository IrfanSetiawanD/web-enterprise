<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- GUEST (Hanya bisa diakses jika BELUM login) ---
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
    Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');
});

// --- AUTH (Hanya bisa diakses jika SUDAH login) ---
Route::middleware('auth')->group(function () {

    // Dashboard Utama
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Management Mahasiswa
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('mahasiswa/simpan', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

    // Edit & Update - Tambahkan tanda tanya (?) pada {id?} agar parameter bersifat opsional di mata rute
    Route::get('mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::post('mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

    // Logout
    Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');
});
