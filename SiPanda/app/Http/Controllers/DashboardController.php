<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Pengguna;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 data edukasi terbaru
        $edukasi = Edukasi::latest()->take(5)->get();

        // Hitung jumlah pengguna dari model Pengguna
        $jumlahUser = Pengguna::count();

        // Kirim data ke view dashboard
        return view('dashboard', compact('edukasi', 'jumlahUser'));
    }
}
