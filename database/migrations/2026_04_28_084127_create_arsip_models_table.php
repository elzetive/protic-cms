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
    Schema::create('arsip_models', function (Blueprint $table) {
        $table->id();
        $table->string('nama_dokumen');
        $table->string('kategori');
        $table->date('tanggal');
        $table->string('status'); // Publik / Internal
        $table->text('deskripsi')->nullable();
        $table->string('file_path'); // Lokasi file di server
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_models');
    }
};
