<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiController extends Controller
{
    public function index()
    {
        $kegiatan = AbsensiModel::latest()->get();
        return view('admin.absensi.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        AbsensiModel::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'waktu'         => $request->waktu,
            'lokasi'        => $request->lokasi,
            'token_absensi' => Str::random(32),
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Kegiatan berhasil dibuat!');
    }
}
