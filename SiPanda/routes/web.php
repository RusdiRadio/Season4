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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// route landingpage
Route::get('/index', function () {
    return view('landingpage.index');
})->name('index');


// route register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//route login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// // route dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// route data user 
Route::get('/dataUser', function () {
    return view('dataUser');
})->name('dataUser');


// route Riwayat
Route::get('/Riwayat', function () {
    return view('Riwayat');
})->name('Riwayat');


// route Edukasi
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
Route::get('/tambahedukasi', [EdukasiController::class, 'tambah'])->name('tambahedukasi');
Route::post('/tambahedukasi/store', [EdukasiController::class, 'store'])->name('tambahedukasi.store');
Route::get('/EditEdukasi/{id}', [EdukasiController::class, 'edit'])->name('EditEdukasi');
Route::put('/UpdateEdukasi/{id}', [EdukasiController::class, 'update'])->name('UpdateEdukasi');
Route::get('/hapusedukasi/{id}', [EdukasiController::class, 'destroy'])->name('HapusEdukasi');



// route pengaturan
Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

// route prediksi
Route::get('/prediksi', function () {
    return view('prediksi');
})->name('prediksi');


// route cetakdata
Route::get('/cetakData', function () {
    return view('cetakData');
})->name('cetakData');




