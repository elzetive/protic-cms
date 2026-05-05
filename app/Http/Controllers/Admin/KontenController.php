<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index()
    {
        $konten = KontenModel::latest()->get();
        return view('admin.konten.index', compact('konten'));
    }

    public function create()
    {
        return view('admin.konten.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'kategori' => 'required|in:Proker,Prestasi',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konten', 'public');
        }

        KontenModel::create($data);
        return redirect()->route('admin.konten.index')->with('success', 'Rekap berhasil ditambahkan');
    }

    public function edit($id)
    {
        $konten = KontenModel::findOrFail($id);
        return view('admin.konten.edit', compact('konten'));
    }

public function update(Request $request, $id)
{
    $konten = KontenModel::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'sub_judul' => 'nullable',
        'kategori' => 'required|in:Proker,Prestasi',
        'isi' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $data = $request->all();
    $data['slug'] = Str::slug($request->judul);

    if ($request->hasFile('gambar')) {
        if ($konten->gambar) Storage::disk('public')->delete($konten->gambar);
        $data['gambar'] = $request->file('gambar')->store('konten', 'public');
    }

    $konten->update($data);
    return redirect()->route('admin.konten.index')->with('success', 'Rekap berhasil diupdate');
}
    public function destroy($id)
    {
        $konten = KontenModel::findOrFail($id);
        if ($konten->gambar) Storage::disk('public')->delete($konten->gambar);
        $konten->delete();
        return redirect()->route('admin.konten.index')->with('success', 'Rekap berhasil dihapus');
    }
}
