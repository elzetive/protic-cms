<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengurusModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengurus';
    protected $fillable = ['mahasiswa_id', 'jabatan', 'divisi', 'angkatan'];

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id');
    }
}
