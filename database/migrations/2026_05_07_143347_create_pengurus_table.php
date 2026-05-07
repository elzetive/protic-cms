<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('jabatan');
            $table->string('divisi')->nullable();
            $table->integer('angkatan');
            $table->timestamps();
            $table->softDeletes();

            // Proteksi agar satu mahasiswa tidak punya 2 jabatan di tahun yang sama
            $table->unique(['mahasiswa_id', 'angkatan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
