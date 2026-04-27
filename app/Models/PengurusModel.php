<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusModel extends Model
{
    use HasFactory;

    protected $table = 'penguruses';

    protected $fillable = [
        'nama', 'nim', 'jabatan', 'divisi', 'angkatan', 'foto', 'instagram'
    ];
}
