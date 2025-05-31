<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'info';
    protected $primaryKey = 'id_info'; // ini yang penting

    protected $fillable = [
        'judul',
        'konten',     // jika konten menyimpan gambar, pastikan penamaannya konsisten
        'deskripsi',
    ];
}