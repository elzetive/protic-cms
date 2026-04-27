<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
public function index()
{
    // 1. Urutan Kasta Jabatan
    $urutanJabatan = "
        CASE
            WHEN UPPER(jabatan) = 'KETUA' THEN 1
            WHEN UPPER(jabatan) = 'WAKIL KETUA' THEN 2
            WHEN UPPER(jabatan) = 'SEKRETARIS' THEN 3
            WHEN UPPER(jabatan) = 'BENDAHARA' THEN 4
            WHEN UPPER(jabatan) = 'KEPALA DIVISI' THEN 5
            WHEN UPPER(jabatan) = 'ANGGOTA' THEN 6
            ELSE 7
        END
    ";

    $urutanDivisi = "
        CASE
            WHEN UPPER(divisi) = 'BADAN PENGURUS HARIAN' THEN 1
            WHEN UPPER(divisi) = 'DIVISI KOMINFO' THEN 2
            WHEN UPPER(divisi) = 'DIVISI HUMAS' THEN 3
            WHEN UPPER(divisi) = 'DIVISI WEB' THEN 4
            WHEN UPPER(divisi) = 'DIVISI UI/UX' THEN 5
            WHEN UPPER(divisi) = 'DIVISI MOBILE' THEN 6
            WHEN UPPER(divisi) = 'DIVISI DATA' THEN 7
            WHEN UPPER(divisi) = 'DIVISI DEVOPS' THEN 8
            ELSE 9
        END
    ";

    $pengurus = \App\Models\PengurusModel::orderByRaw($urutanDivisi)
                ->orderByRaw($urutanJabatan)
                ->orderBy('angkatan', 'desc')
                ->get();

    return view('admin.database.index', compact('pengurus'));
}    public function create()
    {
        return view('admin.database.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:penguruses',
            'jabatan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads/pengurus', 'public');
        }

        PengurusModel::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'angkatan' => $request->angkatan,
            'instagram' => $request->instagram,
            'foto' => $path
        ]);

        return redirect()->route('admin.database.index')->with('success', 'PENGURUS BERHASIL DITAMBAHKAN!');
    }

    public function edit($id)
    {
        $pengurus = PengurusModel::findOrFail($id);
        return view('admin.database.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = PengurusModel::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:penguruses,nim,'.$id,
            'jabatan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('uploads/pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.database.index')->with('success', 'DATA PENGURUS BERHASIL DIPERBARUI!');
    }

    public function destroy($id)
    {
        $pengurus = PengurusModel::findOrFail($id);

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('admin.database.index')->with('success', 'PENGURUS BERHASIL DIHAPUS!');
    }
}
