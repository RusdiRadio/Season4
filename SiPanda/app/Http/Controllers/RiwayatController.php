<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;


class RiwayatController extends Controller
{
    public function index()
{
    $riwayat = Riwayat::all(); // Ambil semua data dari tabel riwayat
    return view('riwayat', compact('riwayat')); // kirim ke blade
}
}
