<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipModel extends Model
{
    protected $fillable = ['nama_dokumen', 'kategori', 'tanggal', 'status', 'deskripsi', 'file_path'];
}
