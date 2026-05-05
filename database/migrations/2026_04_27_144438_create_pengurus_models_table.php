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
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            // Hapus ->unique() dari sini agar NIM bisa duplikat di tabel
            $table->string('nim');
            $table->string('jabatan');
            $table->string('divisi')->nullable();
            $table->string('angkatan');
            $table->string('foto')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();

            /**
             * Tambahkan Unique Constraint untuk kombinasi NIM dan Angkatan.
             * Ini memastikan satu orang (NIM) tidak terdaftar dua kali di angkatan yang sama,
             * tapi BOLEH terdaftar lagi jika angkatannya berbeda.
             */
            $table->unique(['nim', 'angkatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan nama tabel di sini sama dengan yang di up() yaitu 'pengurus'
        Schema::dropIfExists('pengurus');
    }
};
