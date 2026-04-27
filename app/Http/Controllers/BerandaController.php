<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontenModel;

class BerandaController extends Controller
{
    public function index()
    {


        $prestasi = KontenModel::where('kategori', 'Prestasi')
                    ->latest()
                    ->take(4)
                    ->get();

        return view('user.beranda', compact('berita', 'prestasi'));
    }

    public function show($slug)
{
    $konten = \App\Models\KontenModel::where('slug', $slug)->firstOrFail();

    $latest = \App\Models\KontenModel::where('id', '!=', $konten->id)
                ->latest()
                ->take(3)
                ->get();

    return view('user.konten_detail', compact('konten', 'latest'));
}
}
