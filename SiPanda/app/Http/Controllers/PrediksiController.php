<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediksi;


class PrediksiController extends Controller
{
    public function index() {

    $prediksi = Prediksi::all();

    return view('prediksi', compact('prediksi'));

    }

}
