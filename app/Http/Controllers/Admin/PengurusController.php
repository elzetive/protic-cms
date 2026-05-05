<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengurusController extends Controller
{
public function index()
{
    // Hirarki Jabatan SQL
    $urutanJabatan = "CASE
        WHEN UPPER(jabatan) = 'KETUA' THEN 1
        WHEN UPPER(jabatan) = 'WAKIL KETUA' THEN 2
        WHEN UPPER(jabatan) = 'SEKRETARIS' THEN 3
        WHEN UPPER(jabatan) = 'BENDAHARA' THEN 4
        WHEN UPPER(jabatan) = 'KEPALA DIVISI' THEN 5
        ELSE 6 END";

    // Hirarki Divisi SQL
    $urutanDivisi = "CASE
        WHEN UPPER(divisi) = 'BADAN PENGURUS HARIAN' THEN 1
        WHEN UPPER(divisi) = 'DIVISI KOMINFO' THEN 2
        WHEN UPPER(divisi) = 'DIVISI HUMAS' THEN 3
        WHEN UPPER(divisi) = 'DIVISI WEB' THEN 4
        WHEN UPPER(divisi) = 'DIVISI UI/UX' THEN 5
        WHEN UPPER(divisi) = 'DIVISI MOBILE' THEN 6
        WHEN UPPER(divisi) = 'DIVISI DATA' THEN 7
        WHEN UPPER(divisi) = 'DIVISI DEVOPS' THEN 8
        ELSE 9 END";

    $pengurus = PengurusModel::orderByRaw($urutanJabatan)
                ->orderByRaw($urutanDivisi)
                ->orderByRaw("CAST(SUBSTRING(nim, 1, 2) AS UNSIGNED) ASC")
                ->orderBy('nama', 'asc')
                ->get();

    return view('admin.database.index', compact('pengurus'));
}
    public function create()
    {
        return view('admin.database.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => [
                'required',
                Rule::unique('pengurus')->where(function ($query) use ($request) {
                    return $query->where('nim', $request->nim)
                                 ->where('angkatan', $request->angkatan);
                }),
            ],
            'jabatan' => 'required',
            'angkatan' => 'required|numeric|max:' . date('Y'),
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nim.unique' => 'NIM INI SUDAH TERDAFTAR PADA PERIODE TERSEBUT!'
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
            'nim' => [
                'required',
                Rule::unique('pengurus')->where(function ($query) use ($request) {
                    return $query->where('nim', $request->nim)
                                 ->where('angkatan', $request->angkatan);
                })->ignore($id),
            ],
            'jabatan' => 'required',
            'angkatan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nim.unique' => 'NIM INI SUDAH TERDAFTAR PADA PERIODE TERSEBUT!'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('uploads/pengurus', 'public');
        }

        $pengurus->update($data);

return redirect()->route('admin.database.index')
        ->with('success', 'DATA PENGURUS BERHASIL DIPERBARUI!')
        ->with('open_periode', $pengurus->angkatan);    }

    public function destroy($id)
    {
        $pengurus = PengurusModel::findOrFail($id);

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->route('admin.database.index')->with('success', 'PENGURUS BERHASIL DIHAPUS!');
    }

    public function clone($id)
    {
        $pengurusLama = PengurusModel::findOrFail($id);

        $sudahAda = PengurusModel::where('nim', $pengurusLama->nim)
                    ->where('angkatan', $pengurusLama->angkatan + 1)
                    ->exists();

        if ($sudahAda) {
            return back()->with('error', 'PENGURUS INI SUDAH TERDAFTAR DI PERIODE BERIKUTNYA!');
        }

        $pengurusBaru = $pengurusLama->replicate();
        $pengurusBaru->angkatan = $pengurusLama->angkatan + 1;
        $pengurusBaru->jabatan = 'ANGGOTA';
        $pengurusBaru->save();

        return back()->with('success', 'DATA BERHASIL DILANJUTKAN KE PERIODE ' . ($pengurusBaru->angkatan));
    }
public function bulkClone(Request $request)
{
    $ids = $request->ids;
    $targetTahun = $request->target_tahun; // Ambil tahun dari input user

    if (!$ids || !$targetTahun) {
        return back()->with('error', 'PILIH DATA DAN TENTUKAN TAHUN TUJUAN!');
    }

    $count = 0;
    foreach ($ids as $id) {
        $pengurus = PengurusModel::find($id);

        if ($pengurus) {
            // Cek apakah NIM sudah ada di tahun tujuan
            $exists = PengurusModel::where('nim', $pengurus->nim)
                                  ->where('angkatan', $targetTahun)
                                  ->exists();

            if (!$exists) {
                $newPengurus = $pengurus->replicate();
                $newPengurus->angkatan = $targetTahun;
                $newPengurus->jabatan = 'ANGGOTA'; // Default jabatan baru
                $newPengurus->save();
                $count++;
            }
        }
    }

    return back()->with('success', "$count DATA BERHASIL DI-CLONE KE PERIODE $targetTahun/" . ($targetTahun + 1));
}
public function bulkDestroy(Request $request)
{
    $ids = $request->ids;

    if (!$ids || count($ids) == 0) {
        return back()->with('error', 'PILIH SETIDAKNYA SATU DATA UNTUK DIHAPUS!');
    }

    $pengurus = PengurusModel::whereIn('id', $ids)->get();

    foreach ($pengurus as $item) {
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }
        $item->delete();
    }

    return back()->with('success', count($ids) . ' DATA PENGURUS BERHASIL DIHAPUS!');
}
}
