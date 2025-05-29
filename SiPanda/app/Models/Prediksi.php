<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = 'prediksi';
    protected $primaryKey = 'id_prediksi';

    protected $fillable = [
        'id_user',
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
        'status_diagnosa',
        'edukasi',
    ];

    // Jika kamu punya relasi dengan User
    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_user', 'id_user');
    }
}
