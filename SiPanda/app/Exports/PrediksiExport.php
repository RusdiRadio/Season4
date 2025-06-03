<?php

namespace App\Exports;

use App\Models\Prediksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrediksiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Prediksi::select(
            'nama',
            'Umur',
            'Berat_kg',
            'Tinggi_cm',
            'Siklus_Haid',
            'Lingkar_Panggul_cm',
            'Lingkar_Pinggang_cm',
            'Kenaikan_BB',
            'Pertumbuhan_Rambut_di_Area_Tidak_Wajar',
            'Penggelapan_Kulit_di_Area_Lipatan',
            'Kerontokan_Rambut',
            'Jerawat',
            'Sering_Makan_FastFood',
            'BMI',
            'tanggal_diagnosa',
            'status_diagnosa'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Umur',
            'Berat Badan (kg)',
            'Tinggi Badan (cm)',
            'Siklus Haid',
            'Lingkar Panggul (cm)',
            'Lingkar Pinggang (cm)',
            'Kenaikan Berat Badan',
            'Pertumbuhan Rambut Berlebih',
            'Penggelapan Lipatan Kulit',
            'Kerontokan Rambut',
            'Jerawat',
            'Sering Makan FastFood',
            'BMI',
            'Tanggal Diagnosa',
            'Status Diagnosa'
        ];
    }
}
