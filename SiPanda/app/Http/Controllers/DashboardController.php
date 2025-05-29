<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
use App\Models\Riwayat;



class DashboardController extends Controller
{
   public function index()
{
    $edukasi = Edukasi::latest()->take(5)->get();
    $jumlahUser = Pengguna::count();

    $jumlahPCOS = DB::table('prediksi')
                    ->where('status_diagnosa', 'Anda terdiagnosa PCOS')
                    ->count();

    $jumlahTidakPCOS = DB::table('prediksi')
                        ->where('status_diagnosa', 'Anda tidak terdiagnosa PCOS')
                        ->count();

    $jumlahRiwayat = Riwayat::count();

    // Ambil data jumlah diagnosa PCOS per bulan
    $pcosPerMonth = DB::table('prediksi')
        ->select(
            DB::raw('MONTH(tanggal_diagnosa) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->where('status_diagnosa', 'Anda terdiagnosa PCOS')
        ->groupBy(DB::raw('MONTH(tanggal_diagnosa)'))
        ->get()
        ->pluck('total', 'bulan') // hasil: [1 => 5, 2 => 2, ...]
        ->toArray();

    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    // Siapkan array lengkap 12 bulan
    $labels = [];
    $data = [];

    foreach ($namaBulan as $bulan => $nama) {
        $labels[] = $nama;
        $data[] = $pcosPerMonth[$bulan] ?? 0; // pakai 0 kalau tidak ada data
    }

    return view('dashboard', compact(
        'edukasi',
        'jumlahUser',
        'jumlahPCOS',
        'jumlahTidakPCOS',
        'jumlahRiwayat',
        'labels',
        'data'
    ));
}

}
