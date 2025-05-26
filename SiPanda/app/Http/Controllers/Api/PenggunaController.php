<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;

class PenggunaController extends Controller
{
     public function index()
    {
        $pengguna = Pengguna::all(); // Ambil semua data dari tabel 'user'
        return view('dataUser', compact('pengguna')); // Kirim data ke view
    }

    public function store(StorePenggunaRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $pengguna = Pengguna::create($data);
        return response()->json($pengguna, 201);
    }

    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna, 200);
    }

    public function update(UpdatePenggunaRequest $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $pengguna->update($data);
        return response()->json($pengguna, 200);
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();
        return response()->json(null, 204);
    }

    // ini login
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Cek user
        $user = Pengguna::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Username atau password salah'], 401);
        }

        // Jika berhasil, kembalikan token (jika pakai Sanctum, Passport, atau bisa manual)
        // Contoh manual tanpa token
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ], 200);
    }

    //ini untuk register

    public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:100',
        'username' => 'required|string|unique:user,username', // nama tabel tetap 'user'
        'email' => 'required|email|unique:user,email',       // nama tabel tetap 'user'
        'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => 'Validasi gagal',
            'messages' => $validator->errors(),
        ], 422);
    }

    // Buat pengguna dengan model Pengguna
    $pengguna = Pengguna::create([
        'nama' => $request->nama,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'message' => 'Registrasi berhasil',
        'user' => $pengguna,
    ], 201);
}
}
