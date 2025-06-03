<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RiwayatExport;
use App\Exports\PrediksiExport; // import export prediksi
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Riwayat;
use App\Models\Prediksi; // import model prediksi
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportExcel()
    {
    return Excel::download(new RiwayatExport, 'data_Riwayat.xlsx');
    }

    public function exportPDF()
    {
        $riwayat = Riwayat::all();
        $pdf = Pdf::loadView('exports.riwayat-pdf', compact('riwayat'));
        return $pdf->download('data_riwayat.pdf');
    }

    public function exportPrediksiPDF()
{
    $prediksi = Prediksi::all();

    $pdf = Pdf::loadView('exports.prediksi-pdf', compact('prediksi'))
              ->setPaper('a4', 'landscape'); // ← perbaikan: tidak ada titik koma sebelumnya

    return $pdf->download('data_prediksi.pdf');
}

}