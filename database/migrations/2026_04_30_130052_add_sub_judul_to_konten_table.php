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
    Schema::table('konten', function (Blueprint $table) {
        // Menambah kolom sub_judul setelah kolom judul
        $table->string('sub_judul')->after('judul')->nullable();
    });
}

public function down(): void
{
    Schema::table('konten', function (Blueprint $table) {
        $table->dropColumn('sub_judul');
    });
}
};
