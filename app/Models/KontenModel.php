<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenModel extends Model
{
    use HasFactory;

    // Karena nama class pakai akhiran 'Model',
    // kita definisikan nama tabel secara manual agar Laravel tidak bingung
    protected $table = 'kontens';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'isi',
        'gambar',
    ];
}
