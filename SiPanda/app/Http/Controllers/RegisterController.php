<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('layouts.register'); // Pastikan view ini ada
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:admin,username',
            'email' => 'required|email|unique:admin,email',
            'password' => [
                'required',
                'string',
                'size:8', // tepat 8 karakter
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8}$/', // kombinasi huruf dan angka
                'confirmed' // pastikan ada field password_confirmation dan cocok
            ],
            'terms' => 'accepted',
        ], [
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka, 8 karakter tepat.',
            'password.size' => 'Password harus tepat 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan username lain.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
        ]);

        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
