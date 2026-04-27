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
    Schema::create('penguruses', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nim')->unique();
        $table->string('jabatan'); // Ketua, Sekertaris, Koordinator Divisi, dll
        $table->string('divisi')->nullable(); // Web, Mobile, UI/UX, Hardware
        $table->string('angkatan'); // Contoh: 2024
        $table->string('foto')->nullable();
        $table->string('instagram')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_models');
    }
};
