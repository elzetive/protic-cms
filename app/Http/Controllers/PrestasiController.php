<?php

namespace App\Http\Controllers;

use App\Models\KontenModel;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasiList = KontenModel::where('kategori', 'Prestasi')
                        ->orderBy('judul', 'asc')
                        ->get();

        $data = [
            'desc' => 'Dedikasi dan kerja keras anggota UKM PROTIC telah membuahkan berbagai pencapaian membanggakan, mulai dari kompetisi tingkat regional hingga nasional di bidang pengembangan perangkat lunak dan solusi teknologi.',
            'img_main' => 'prestasi.jpg',
            'achievements' => $prestasiList
        ];

        return view('user.prestasi', compact('data'));
    }
}
