<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KehadiranModel extends Model
{
    use HasFactory;

    protected $table = 'kehadirans';

    protected $fillable = ['absensi_id', 'nama'];

    public function absensi()
    {
        return $this->belongsTo(AbsensiModel::class, 'absensi_id');
    }
}
