<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    use HasFactory;

    protected $table = 'absensi_models';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'lokasi',
        'token_absensi'
    ];

    public function kehadiran()
    {
        return $this->hasMany(KehadiranModel::class, 'absensi_id');
    }
}
