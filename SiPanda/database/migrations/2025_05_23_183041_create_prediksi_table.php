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
        Schema::create('prediksi', function (Blueprint $table) {
        $table->id('id_prediksi');
        $table->unsignedBigInteger('id_user');
        $table->string('nama');
        $table->integer('Umur');                        // numeric input, jadi integer
        $table->float('Berat_kg');                      // float sesuai berat badan
        $table->float('Tinggi_cm');                     // float sesuai tinggi badan
        $table->string('Siklus_Haid');                 // input numeric, ganti jadi integer
        $table->float('Lingkar_Panggul_cm');            // float
        $table->float('Lingkar_Pinggang_cm');           // float
        $table->boolean('Kenaikan_BB');                  // boolean
        $table->boolean('Pertumbuhan_Rambut_di_Area_Tidak_Wajar'); // boolean
        $table->boolean('Penggelapan_Kulit_di_Area_Lipatan');      // boolean
        $table->boolean('Kerontokan_Rambut');            // boolean
        $table->boolean('Jerawat');                       // boolean
        $table->boolean('Sering_Makan_FastFood');        // boolean
        $table->float('BMI');                             // float
        $table->date('tanggal_diagnosa');
        $table->string('status_diagnosa');
        $table->text('edukasi')->nullable();
        $table->timestamps();

        // Relasi foreign key
        $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediksi');
    }
};
