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
        Schema::create('master_data_statistik_kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string('jumlah_penduduk');
            $table->string('penduduk_laki-laki');
            $table->string('penduduk_perempuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_data_statistik_kelurahans');
    }
};
