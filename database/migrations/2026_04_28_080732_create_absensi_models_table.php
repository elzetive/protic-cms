<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('absensi_models', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kegiatan');
        $table->date('tanggal');
        $table->time('waktu');
        $table->string('lokasi');
        $table->string('token_absensi')->unique(); // Untuk link QR Code nanti
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_models');
    }
};
