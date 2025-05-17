<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function edit() {
        return view('EditEdukasi');
    }

    public function tambah() {
        return view('tambahedukasi');
    }

    public function index() {
        return view('edukasi');
    }

}
