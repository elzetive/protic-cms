<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratModel extends Model
{
    protected $table = 'surat_models';

    protected $fillable = [
        'nomor_surat',
        'hal',
        'tujuan',
        'agenda_kegiatan',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'tempat_kegiatan',
        'nama_ketua',
        'nim_ketua',
        'nama_pembina',
        'nip_pembina'
    ];
}
