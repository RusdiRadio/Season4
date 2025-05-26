<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;

    protected $table = 'edukasi';
    protected $primaryKey = 'id_edukasi'; // ini yang penting

   protected $fillable = [
    'judul',
    'konten',     // sesuai kolom di database, kalau konten ini untuk gambar, pastikan penamaannya konsisten
    'deskripsi',
];

}
