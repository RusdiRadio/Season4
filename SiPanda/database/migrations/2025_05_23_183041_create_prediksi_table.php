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
            $table->integer('Umur');
            $table->float('Berat_Badan');
            $table->float('Tinggi_Badan');
            $table->string('Siklus_Menstruasi');
            $table->float('Lingkar_Pinggul');
            $table->float('Lingkar_Pinggang');
            $table->boolean('Kenaikan_Berat_Badan');
            $table->boolean('Pertumbuhan_Rambut_Berlebih');
            $table->boolean('Penggelapan_Lipatan_Kulit');
            $table->boolean('Kerontokan_Rambut');
            $table->boolean('Jerawat');
            $table->boolean('fastfood');
            $table->float('BMI');
            $table->date('tanggal_diagnosa');
            $table->string('status_diagnosa');
            $table->text('edukasi')->nullable();
            $table->timestamps();

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
