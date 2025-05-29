<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminProfileController; // <-- ini yang kurang
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\VisualisasiController;
use App\Http\Controllers\RiwayatController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public
Route::get('/', fn() => view('landingpage.index'));
Route::get('/index', fn() => view('landingpage.index'))->name('index');
Route::get('/tentang', function () {
    return view('landingpage.tentang');
})->name('tentang');

Route::get('/pengenalan', function () {
    return view('landingpage.pengenalan');
})->name('pengenalan');
Route::get('/edukasii', function () {
    return view('landingpage.edukasii');
})->name('edukasii');

// Registration
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua route berikut wajib login dan tidak boleh di‐cache
Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data User
    Route::get('/dataUser', [PenggunaController::class, 'index'])->name('dataUser');
    Route::get('/data-user', [PenggunaController::class, 'index'])->name('dataUser.index');


    // Riwayat
Route::get('/Riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    // visualisasi
    Route::get('/visualisasi', fn() => view('visualisasi'))->name('visualisasi');

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
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi');

    //route visualisasi
    Route::get('/visualisasi', [VisualisasiController::class, 'index'])->name('visualisasi');


    // Cetak Data
    Route::get('/cetakData', fn() => view('cetakData'))->name('cetakData');

    Route::prefix('pengaturan')->middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/', [AdminProfileController::class, 'index'])->name('pengaturan.index');
    Route::post('/upload', [AdminProfileController::class, 'upload'])->name('pengaturan.upload');
    Route::delete('/foto', [AdminProfileController::class, 'delete'])->name('pengaturan.foto.delete');
    Route::put('/', [AdminProfileController::class, 'update'])->name('pengaturan.update');
});


});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Menampilkan form reset password (dari link email)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Menangani submit form reset password
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');