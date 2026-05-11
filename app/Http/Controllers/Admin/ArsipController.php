<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArsipModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
public function index(Request $request) {
    $query = ArsipModel::query();

    if ($request->has('filter')) {
        $query->where('kategori', $request->filter);
    }

    $arsip = $query->latest()->get();

    $allArsip = ArsipModel::all();

    return view('admin.arsip.index', compact('arsip', 'allArsip'));
}
    public function tambah() {
        return view('admin.arsip.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'kategori'     => 'required',
            'tanggal'      => 'required|date',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        $filePath = $request->file('file_dokumen')->store('arsip', 'public');

        ArsipModel::create([
            'nama_dokumen' => strtoupper($request->nama_dokumen),
            'kategori'     => $request->kategori,
            'tanggal'      => $request->tanggal,
            'deskripsi'    => strtoupper($request->deskripsi),
            'status'       => 'PUBLIK',
            'file_path'    => $filePath,
        ]);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil disimpan!');
    }

    public function destroy($id)
    {
        $arsip = ArsipModel::findOrFail($id);

        if ($arsip->file_path && Storage::disk('public')->exists($arsip->file_path)) {
            Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }
}
