<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipModel;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index() {
        $arsip = ArsipModel::latest()->get();
        return view('admin.arsip.index', compact('arsip'));
    }

    public function tambah() {
        return view('admin.arsip.tambah');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_dokumen' => 'required',
            'kategori'     => 'required',
            'tanggal'      => 'required|date',
            'status'       => 'required',
            'file_dokumen' => 'required|mimes:pdf,docx,xlsx|max:5120',
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $path = $file->store('arsip_dokumen', 'public');

            ArsipModel::create([
                'nama_dokumen' => $request->nama_dokumen,
                'kategori'     => $request->kategori,
                'tanggal'      => $request->tanggal,
                'status'       => $request->status,
                'deskripsi'    => $request->deskripsi,
                'file_path'    => $path,
            ]);
        }

        return redirect()->route('admin.arsip.index')->with('success', 'Dokumen berhasil diarsipkan!');
    }
}
