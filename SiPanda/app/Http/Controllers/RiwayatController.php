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

// Method baru untuk API
    public function getLatestStatusByUserId($id_user)
{
    // Ambil 1 data riwayat terbaru berdasar tanggal_diagnosa atau created_at
    $riwayat = Riwayat::where('id_user', $id_user)
        ->orderByDesc('tanggal_diagnosa')
        ->orOrderByDesc('created_at')
        ->first(['status']);

    if ($riwayat) {
        return response()->json([
            'status' => 'success',
            'data' => $riwayat->status,
        ]);
    } else {
        return response()->json([
            'status' => 'empty',
            'data' => null,
        ]);
    }
}
}
