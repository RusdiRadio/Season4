<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\VisualisasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\InfoEdukasiController;
use App\Http\Controllers\LandingpageController;








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
Route::get('/edukasii', [LandingpageController::class, 'edukasiAll'])->name('edukasii');


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
    Route::get('/export/excel', [ExportController::class, 'exportExcel']);
    Route::get('/export/pdf', [ExportController::class, 'exportPDF']);

    // visualisasi
    Route::get('/visualisasi', fn() => view('visualisasi'))->name('visualisasi');

    Route::get('/info-edukasi', [InfoEdukasiController::class, 'index'])->name('info-edukasi');

    // CRUD Edukasi
    Route::get('/edukasi', [InfoEdukasiController::class, 'index'])->name('edukasi');
    Route::get('/tambahedukasi', [EdukasiController::class, 'tambah'])->name('tambahedukasi');
    Route::post('/tambahedukasi/store', [EdukasiController::class, 'store'])->name('tambahedukasi.store');
    Route::get('/EditEdukasi/{id}', [EdukasiController::class, 'edit'])->name('EditEdukasi');
    Route::put('/UpdateEdukasi/{id}', [EdukasiController::class, 'update'])->name('UpdateEdukasi');
    Route::get('/hapusedukasi/{id}', [EdukasiController::class, 'destroy'])->name('HapusEdukasi');
    Route::get('/edukasi/{id}', [EdukasiController::class, 'show']);


    //CRUD Info
    Route::get('/edukasi', [InfoEdukasiController::class, 'index'])->name('edukasi');
    Route::get('/info/tambah', [InfoController::class, 'tambah'])->name('tambahinfo');
    Route::post('/info/store', [InfoController::class, 'store'])->name('tambahinfo.store');
    Route::get('/info/edit/{id_info}', [InfoController::class, 'edit'])->name('editinfo');
    Route::put('/info/update/{id}', [InfoController::class, 'update'])->name('updateinfo');
    Route::delete('/info/delete/{id}', [InfoController::class, 'destroy'])->name('deleteinfo');


    // Pengaturan
    Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');

    // Prediksi
    Route::get('/export/prediksi/pdf', [ExportController::class, 'exportPrediksiPDF'])->name('export.prediksi.pdf');
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi');
    Route::get('/edukasi-pcos', function() {
    // Ambil semua data dari tabel info
    $edukasi = DB::table('info')->get();

    

    // Kembalikan data dalam format JSON
    return response()->json($edukasi);
});


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
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

    // Menangani submit form reset password
    Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');