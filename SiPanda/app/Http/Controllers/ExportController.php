<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RiwayatExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Riwayat;
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
}