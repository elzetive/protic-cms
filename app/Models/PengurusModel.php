<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengurusModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pengurus';

    protected $fillable = [
        'nama', 'nim', 'jabatan', 'divisi', 'angkatan', 'foto', 'instagram'
    ];
}
