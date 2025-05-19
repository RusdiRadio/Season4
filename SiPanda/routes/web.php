<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public
Route::get('/', fn() => view('welcome'));
Route::get('/index', fn() => view('landingpage.index'))->name('index');

// Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout (POST!)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth','prevent-back-history'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    // … route lain …
});



// Semua route berikut wajib login dan tidak boleh di‐cache (prevent back history)
Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data User
    Route::get('/dataUser', fn() => view('dataUser'))->name('dataUser');

    // Riwayat
    Route::get('/Riwayat', fn() => view('Riwayat'))->name('Riwayat');

    // CRUD Edukasi
    Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
    Route::get('/tambahedukasi', [EdukasiController::class, 'tambah'])->name('tambahedukasi');
    Route::post('/tambahedukasi/store', [EdukasiController::class, 'store'])->name('tambahedukasi.store');
    Route::get('/EditEdukasi/{id}', [EdukasiController::class, 'edit'])->name('EditEdukasi');
    Route::put('/UpdateEdukasi/{id}', [EdukasiController::class, 'update'])->name('UpdateEdukasi');
    Route::get('/hapusedukasi/{id}', [EdukasiController::class, 'destroy'])->name('HapusEdukasi');

    // Pengaturan
    Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');

    // Prediksi
    Route::get('/prediksi', fn() => view('prediksi'))->name('prediksi');

    // Cetak Data
    Route::get('/cetakData', fn() => view('cetakData'))->name('cetakData');

});
