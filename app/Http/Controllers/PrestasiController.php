<?php

namespace App\Http\Controllers;

use App\Models\KontenModel;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        // Mengambil konten dengan kategori 'Prestasi' dari database
        $prestasiList = KontenModel::where('kategori', 'Prestasi')
                        ->orderBy('judul', 'asc')
                        ->get();

        $data = [
            'desc' => 'Dedikasi dan kerja keras anggota UKM PROTIC telah membuahkan berbagai pencapaian membanggakan, mulai dari kompetisi tingkat regional hingga nasional di bidang pengembangan perangkat lunak dan solusi teknologi.',
            'img_main' => 'prestasi.jpg', // File ini tetap di public/img/
            'achievements' => $prestasiList
        ];

        return view('user.prestasi', compact('data'));
    }
}
