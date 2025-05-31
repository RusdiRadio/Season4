<?php

namespace App\Http\Controllers;

use App\Models\edukasi;
use App\Models\info;

class InfoEdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::all();
        $info = Info::all();

        return view('edukasi', compact('edukasi', 'info'));
    }
}
