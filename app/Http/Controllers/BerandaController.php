<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenModel;
use App\Models\PengurusModel;

class BerandaController extends Controller
{
    public function index()
    {
        $periodeTerbaru = PengurusModel::max('angkatan');

        $proker = KontenModel::where('kategori', 'Proker')->latest()->take(4)->get();
        $prestasi = KontenModel::where('kategori', 'Prestasi')->latest()->take(4)->get();

        return view('user.beranda', compact('proker', 'prestasi', 'periodeTerbaru'));
    }

    public function show($slug)
    {
        $konten = KontenModel::where('slug', $slug)->firstOrFail();

        $kontenLainnya = KontenModel::where('id', '!=', $konten->id)
                            ->latest()
                            ->take(3)
                            ->get();

        return view('user.konten_detail', compact('konten', 'kontenLainnya'));
    }
}
