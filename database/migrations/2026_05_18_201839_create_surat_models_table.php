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
        Schema::create('surat_models', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('hal');
            $table->string('tujuan');
            $table->string('agenda_kegiatan');
            $table->string('tanggal_kegiatan');
            $table->string('waktu_kegiatan');
            $table->string('tempat_kegiatan');
            $table->string('nama_ketua');
            $table->string('nim_ketua');
            $table->string('nama_pembina');
            $table->string('nip_pembina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_models');
    }
};
