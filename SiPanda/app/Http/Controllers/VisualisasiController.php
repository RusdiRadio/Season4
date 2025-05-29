<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VisualisasiController extends Controller
{
    public function index()
    {
        // Ambil data prediksi berdasarkan umur (hanya yang terdiagnosa PCOS)
        $pieData = DB::table('prediksi')
            ->select('Umur', DB::raw('COUNT(*) as total'))
            ->where('status_diagnosa', 'Anda terdiagnosa PCOS')
            ->groupBy('Umur')
            ->orderBy('Umur')
            ->get();

        // Pisahkan untuk digunakan di blade
        $pieLabels = $pieData->pluck('Umur')->toArray();      // Contoh: [20, 22, 24]
        $pieSeries = $pieData->pluck('total')->toArray();    // Contoh: [4, 3, 1]

        return view('visualisasi', compact('pieLabels', 'pieSeries'));
    }
}
