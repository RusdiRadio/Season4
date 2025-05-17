<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('edukasi', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('konten'); // menyimpan nama/path file gambar
        $table->text('deskripsi')->nullable();
        $table->date('tanggal_buat')->nullable();
        $table->timestamps(); // created_at dan updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
