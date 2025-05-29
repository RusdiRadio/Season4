<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Prediksi;
use App\Models\Riwayat;

use Carbon\Carbon;

class PcosController extends Controller
{
    public function predict(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        "id_user" => "required|exists:user,id_user",
        "nama" => "required|string",
        "Umur" => "required|numeric",
        "Berat_kg" => "required|numeric",         // huruf kecil "k"
        "Tinggi_cm" => "required|numeric",
        "Siklus_Haid" => "required|numeric",
        "Lingkar_Panggul_cm" => "required|numeric",
        "Lingkar_Pinggang_cm" => "required|numeric",
        "Kenaikan_BB" => "required|boolean",
        "Pertumbuhan_Rambut_di_Area_Tidak_Wajar" => "required|boolean",
        "Penggelapan_Kulit_di_Area_Lipatan" => "required|boolean",
        "Kerontokan_Rambut" => "required|boolean",
        "Jerawat" => "required|boolean",
        "Sering_Makan_FastFood" => "required|boolean",
        "BMI" => "required|numeric"
]);

    // Kirim request ke API Flask
    $response = Http::post("http://localhost:5000/api/predict", [
    "Umur" => $validated["Umur"],
    "Berat_kg" => $validated["Berat_kg"],
    "Tinggi_cm" => $validated["Tinggi_cm"],
    "Siklus_Haid" => $validated["Siklus_Haid"],
    "Lingkar_Panggul_cm" => $validated["Lingkar_Panggul_cm"],
    "Lingkar_Pinggang_cm" => $validated["Lingkar_Pinggang_cm"],
    "Kenaikan_BB" => $validated["Kenaikan_BB"],
    "Pertumbuhan_Rambut_di_Area_Tidak_Wajar" => $validated["Pertumbuhan_Rambut_di_Area_Tidak_Wajar"],
    "Penggelapan_Kulit_di_Area_Lipatan" => $validated["Penggelapan_Kulit_di_Area_Lipatan"],
    "Kerontokan_Rambut" => $validated["Kerontokan_Rambut"],
    "Jerawat" => $validated["Jerawat"],
    "Sering_Makan_FastFood" => $validated["Sering_Makan_FastFood"],
    "BMI" => $validated["BMI"]
]);

    if ($response->successful()) {
        $result = $response->json();

        // Simpan ke database prediksi
        $prediksi = Prediksi::create([
            'id_user' => $validated['id_user'],
            'nama' => $validated['nama'],
            'Umur' => $validated['Umur'],
            'Berat_kg' => $validated['Berat_kg'],
            'Tinggi_cm' => $validated['Tinggi_cm'],
            'Siklus_Haid' => $validated['Siklus_Haid'],
            'Lingkar_Panggul_cm' => $validated['Lingkar_Panggul_cm'],
            'Lingkar_Pinggang_cm' => $validated['Lingkar_Pinggang_cm'],
            'Kenaikan_BB' => $validated['Kenaikan_BB'],
            'Pertumbuhan_Rambut_di_Area_Tidak_Wajar' => $validated['Pertumbuhan_Rambut_di_Area_Tidak_Wajar'],
            'Penggelapan_Kulit_di_Area_Lipatan' => $validated['Penggelapan_Kulit_di_Area_Lipatan'],
            'Kerontokan_Rambut' => $validated['Kerontokan_Rambut'],
            'Jerawat' => $validated['Jerawat'],
            'Sering_Makan_FastFood' => $validated['Sering_Makan_FastFood'],
            'BMI' => $validated['BMI'],
            'tanggal_diagnosa' => Carbon::now()->toDateString(),
            'status_diagnosa' => $result['status'] ?? 'Tidak diketahui',
            'edukasi' => $result['edukasi'] ?? null,
        ]);

        // Simpan juga ke tabel riwayat
        Riwayat::create([
            'id_user' => $validated['id_user'],
            'nama' => $validated['nama'],
            'umur' => $validated['Umur'],
            'tanggal_diagnosa' => Carbon::now()->toDateString(),
            'status' => $result['status'] ?? 'Tidak diketahui',
        ]);

        return response()->json([
            'message' => 'Berhasil memprediksi dan menyimpan hasil.',
            'data' => $prediksi,
            'prediction_result' => $result,
        ]);
    }

    return response()->json(['error' => 'Gagal memproses prediksi dari Flask'], 500);
}

}
