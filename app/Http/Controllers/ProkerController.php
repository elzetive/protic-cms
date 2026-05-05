<?php

namespace App\Http\Controllers;

use App\Models\KontenModel;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    public function index()
    {
        $prokerList = KontenModel::where('kategori', 'Proker')
                        ->orderBy('judul', 'asc')
                        ->get();

        $data = [
            'desc' => 'Program kerja Protic PNC periode ini difokuskan sebagai wadah kolaborasi untuk mencetak kader yang kompeten dalam pengembangan perangkat lunak dan inovasi digital.',
            'img_main' => 'proker.jpg',
            'programs' => $prokerList
        ];

        return view('user.proker', compact('data'));
    }
}
