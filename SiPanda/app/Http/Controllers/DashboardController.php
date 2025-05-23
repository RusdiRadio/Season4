<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edukasi;

class DashboardController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::latest()->take(5)->get(); // Ambil 5 data edukasi terbaru
        $jumlahUser = DB::table('user')->count();     // Hitung jumlah user

        return view('dashboard', compact('edukasi', 'jumlahUser'));
    }
}
