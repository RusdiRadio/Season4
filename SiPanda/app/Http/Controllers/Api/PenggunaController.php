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
    $pengguna = Pengguna::find($id);

    if (!$pengguna) {
        return response()->json([
            'status' => 'error',
            'message' => 'Pengguna tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'status' => 'success',
        'data' => [
            'id' => $pengguna->id_user,
            'username' => $pengguna->username,
            'nama' => $pengguna->nama,
            'email' => $pengguna->email
        ]
    ], 200);
}
    public function update(Request $request, $id)
{
    // Cari user berdasarkan id
    $user = Pengguna::findOrFail($id);

    $request->validate([
    'username' => 'required|string|max:255',
    'nama'     => 'required|string|max:255',
    'email'    => 'required|email|max:255',
    'password' => 'nullable|string|min:8',
    'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // maks 2MB
]);


   // Update data user
$user->username = $request->input('username');
$user->nama     = $request->input('nama');
$user->email    = $request->input('email');

// Jika password diisi, update dan encrypt
if ($request->filled('password')) {
    $user->password = bcrypt($request->input('password'));
}

// Jika ada file foto di-upload, simpan
if ($request->hasFile('foto')) {
    $foto = $request->file('foto');
    $namaFile = time() . '_' . $foto->getClientOriginalName();
    $foto->move(public_path('uploads/profil'), $namaFile);

    // Hapus foto lama jika ada
    if ($user->foto && file_exists(public_path($user->foto))) {
        unlink(public_path($user->foto));
    }

    // Simpan path foto baru
    $user->foto = 'uploads/profil/' . $namaFile;
}

$user->save();

    $user->save();

    // Kembalikan response JSON dengan data terbaru
    return response()->json($user);
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

    // Kembalikan data user secara eksplisit tanpa token
    return response()->json([
        'message' => 'Login berhasil',
        'user' => [
            'id' => $user->id_user,
            'username' => $user->username,
            'name' => $user->nama,
            'email' => $user->email,
            // kalau perlu, tambahkan properti lain
        ],
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

