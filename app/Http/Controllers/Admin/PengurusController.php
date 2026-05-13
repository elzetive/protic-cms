<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PengurusController extends Controller
{
    public function index()
    {
        $urutanJabatan = "CASE
            WHEN UPPER(jabatan) = 'KETUA' THEN 1
            WHEN UPPER(jabatan) = 'WAKIL KETUA' THEN 2
            WHEN UPPER(jabatan) = 'SEKRETARIS' THEN 3
            WHEN UPPER(jabatan) = 'BENDAHARA' THEN 4
            WHEN UPPER(jabatan) = 'KEPALA DIVISI' THEN 5
            ELSE 6 END";

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

        $pengurus = PengurusModel::select('pengurus.*')
            ->join('mahasiswa', 'pengurus.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderByRaw($urutanJabatan)
            ->orderByRaw($urutanDivisi)
            ->orderByRaw("CAST(SUBSTRING(mahasiswa.nim, 1, 2) AS UNSIGNED) ASC")
            ->orderBy('mahasiswa.nama', 'asc')
            ->with('mahasiswa')
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
            'nama'     => 'required|string|max:255',
            'nim'      => 'required|string|max:20',
            'jabatan'  => 'required',
            'divisi'   => 'required',
            'angkatan' => 'required|numeric',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nama.required' => 'NAMA LENGKAP WAJIB DIISI!',
            'nim.required'  => 'NIM WAJIB DIISI!',
        ]);

        $mahasiswa = MahasiswaModel::updateOrCreate(
            ['nim' => $request->nim],
            [
                'nama' => strtoupper($request->nama),
                'instagram' => strtoupper($request->instagram),
            ]
        );

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto) Storage::disk('public')->delete($mahasiswa->foto);
            $mahasiswa->foto = $request->file('foto')->store('uploads/pengurus', 'public');
            $mahasiswa->save();
        }

        $sudahAda = PengurusModel::where('mahasiswa_id', $mahasiswa->id)
                                 ->where('angkatan', $request->angkatan)
                                 ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->withErrors(['nim' => 'GAGAL! MAHASISWA DENGAN NIM ' . $request->nim . ' SUDAH TERDAFTAR SEBAGAI PENGURUS PADA PERIODE ' . $request->angkatan]);
        }

        PengurusModel::create([
            'mahasiswa_id' => $mahasiswa->id,
            'jabatan'      => strtoupper($request->jabatan),
            'divisi'       => strtoupper($request->divisi),
            'angkatan'     => $request->angkatan,
        ]);

        return redirect()->route('admin.database.index')->with('success', 'PENGURUS BERHASIL DITAMBAHKAN!');
    }

    public function edit($id)
    {
        $pengurus = PengurusModel::with('mahasiswa')->findOrFail($id);
        return view('admin.database.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = PengurusModel::with('mahasiswa')->findOrFail($id);
        $mahasiswa = $pengurus->mahasiswa;

        $request->validate([
            'nama'     => 'required',
            'nim'      => 'required',
            'jabatan'  => 'required',
            'angkatan' => 'required',
            'foto'     => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $cekNimLain = MahasiswaModel::where('nim', $request->nim)->first();
        if ($cekNimLain && $cekNimLain->id !== $mahasiswa->id) {
             $duplikatPeriode = PengurusModel::where('mahasiswa_id', $cekNimLain->id)
                                            ->where('angkatan', $request->angkatan)
                                            ->where('id', '!=', $id)
                                            ->exists();
             if ($duplikatPeriode) {
                 return back()->withErrors(['nim' => 'NIM TERSEBUT SUDAH DIGUNAKAN OLEH PENGURUS LAIN DI PERIODE INI!']);
             }
        }

        $mahasiswa->update([
            'nama'      => strtoupper($request->nama),
            'nim'       => $request->nim,
            'instagram' => strtoupper($request->instagram)
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto) Storage::disk('public')->delete($mahasiswa->foto);
            $mahasiswa->foto = $request->file('foto')->store('uploads/pengurus', 'public');
            $mahasiswa->save();
        }

        $pengurus->update([
            'jabatan'  => strtoupper($request->jabatan),
            'divisi'   => strtoupper($request->divisi),
            'angkatan' => $request->angkatan
        ]);

        return redirect()->route('admin.database.index')
            ->with('success', 'DATA BERHASIL DIPERBARUI!')
            ->with('open_periode', $pengurus->angkatan);
    }

    public function destroy($id)
    {
        $pengurus = PengurusModel::findOrFail($id);
        $pengurus->delete();
        return redirect()->route('admin.database.index')->with('success', 'DATA PENGURUS BERHASIL DIHAPUS!');
    }

    public function bulkClone(Request $request)
    {
        $ids = $request->ids;
        $targetTahun = $request->target_tahun;

        if (!$ids || !$targetTahun) {
            return back()->with('error', 'PILIH DATA DAN TENTUKAN TAHUN TUJUAN!');
        }

        $count = 0;
        foreach ($ids as $id) {
            $pengurus = PengurusModel::find($id);

            if ($pengurus) {
                $exists = PengurusModel::withTrashed()
                                      ->where('mahasiswa_id', $pengurus->mahasiswa_id)
                                      ->where('angkatan', $targetTahun)
                                      ->first();

                if (!$exists) {
                    $newPengurus = $pengurus->replicate();
                    $newPengurus->angkatan = $targetTahun;
                    $newPengurus->jabatan = 'ANGGOTA';
                    $newPengurus->deleted_at = null;
                    $newPengurus->save();
                    $count++;
                } elseif ($exists->trashed()) {
                    $exists->restore();
                    $exists->update(['jabatan' => 'ANGGOTA']);
                    $count++;
                }
            }
        }

        return back()->with('success', "$count DATA BERHASIL DI-CLONE KE PERIODE $targetTahun");
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || count($ids) == 0) {
            return back()->with('error', 'PILIH SETIDAKNYA SATU DATA UNTUK DIHAPUS!');
        }

        PengurusModel::whereIn('id', $ids)->delete();
        return back()->with('success', count($ids) . ' DATA PENGURUS BERHASIL DIHAPUS!');
    }
}
