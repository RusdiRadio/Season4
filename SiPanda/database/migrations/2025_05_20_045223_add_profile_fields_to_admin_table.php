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
        Schema::table('admin', function (Blueprint $table) {
        $table->string('pekerjaan')->nullable();
        $table->string('alamat')->nullable();
        $table->string('no_hp')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('admin', function (Blueprint $table) {
        $table->dropColumn(['pekerjaan', 'alamat', 'no_hp']);
    });
    }
};
