<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = ['nim', 'nama', 'foto', 'instagram'];

    public function pengurus()
    {
        return $this->hasMany(PengurusModel::class, 'mahasiswa_id');
    }
}
