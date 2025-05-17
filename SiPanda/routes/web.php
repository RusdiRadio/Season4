<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\Auth\RegisterController;





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
Route::get('/register', function () {
    return view('layouts.register');
})->name('register');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');


//route login
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');



// route dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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
Route::get('/Edukasi', function () {
    return view('Edukasi');
})->name('Edukasi');

Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi');
Route::get('/EditEdukasi', [EdukasiController::class, 'edit'])->name('EditEdukasi');
Route::get('/tambahedukasi', [EdukasiController::class, 'tambah'])->name('tambahedukasi');



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




