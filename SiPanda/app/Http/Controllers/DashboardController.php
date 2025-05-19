<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;

class DashboardController extends Controller
{
   public function index()
{
    $edukasi = Edukasi::latest()->take(5)->get(); // Ambil 5 data edukasi terbaru
    return view('dashboard', compact('edukasi'));
}

}
