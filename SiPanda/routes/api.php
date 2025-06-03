<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\PcosController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH
Route::post('/login', [PenggunaController::class, 'login']);
Route::post('/register', [PenggunaController::class, 'register']);

// ENDPOINT TAMBAHAN UNTUK FLUTTER
Route::get('/get-user/{id}', [PenggunaController::class, 'show']);
Route::put('/update-profile/{id}', [PenggunaController::class, 'update']);

// PREDIKSI PCOS
Route::post('/predict-pcos', [PcosController::class, 'predict']);
