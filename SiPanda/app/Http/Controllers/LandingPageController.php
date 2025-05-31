<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;

class LandingpageController extends Controller
{
    public function edukasiAll()
    {
        $edukasii = Edukasi::all(); // Ambil semua data edukasi
        return view('landingpage.edukasii', compact('edukasii')); // <--- sesuaikan dengan nama blade kamu
    }
}