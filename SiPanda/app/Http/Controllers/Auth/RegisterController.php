<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('layouts.register'); // Pastikan file register.blade.php ada di resources/views/auth/
    }
}
