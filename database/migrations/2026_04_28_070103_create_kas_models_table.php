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
    Schema::create('kas', function (Blueprint $table) {
        $table->id();
        $table->enum('tipe', ['Masuk', 'Keluar']);
        $table->string('kategori'); // Iuran, Proker, Perlengkapan, dll
        $table->bigInteger('nominal');
        $table->text('keterangan');
        $table->date('tanggal');
        $table->string('bukti')->nullable(); // Foto nota
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_models');
    }
};
