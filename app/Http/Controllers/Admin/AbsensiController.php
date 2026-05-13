<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiModel;
use App\Models\KehadiranModel;
use App\Models\PengurusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $kegiatan = AbsensiModel::with('kehadiran')->latest()->get();
        return view('admin.absensi.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal'       => 'required|date',
            'waktu'         => 'required',
            'lokasi'        => 'required',
        ]);

        AbsensiModel::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'waktu'         => $request->waktu,
            'lokasi'        => $request->lokasi,
            'token_absensi' => Str::random(32),
        ]);

        return redirect()->route('admin.absensi.index')->with('success', 'Kegiatan berhasil dibuat!');
    }

    public function show($id)
    {
        $kegiatan = AbsensiModel::with('kehadiran')->findOrFail($id);
        return view('admin.absensi.detail', compact('kegiatan'));
    }

    public function destroy($id)
    {
        $kegiatan = AbsensiModel::findOrFail($id);
        $kegiatan->delete();
        return redirect()->route('admin.absensi.index')->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function showFormAbsen($token)
    {
        $kegiatan = AbsensiModel::where('token_absensi', $token)->firstOrFail();
        $tahunKegiatan = Carbon::parse($kegiatan->tanggal)->format('Y');

        $daftarPengurus = PengurusModel::query()
            ->join('mahasiswa', 'pengurus.mahasiswa_id', '=', 'mahasiswa.id')
            ->select('pengurus.*', 'mahasiswa.nama as nama_mhs')
            ->where('pengurus.angkatan', $tahunKegiatan)
            ->whereNull('pengurus.deleted_at')
            ->orderBy('mahasiswa.nama', 'asc')
            ->get();

        if($daftarPengurus->isEmpty()){
            $daftarPengurus = PengurusModel::query()
                ->join('mahasiswa', 'pengurus.mahasiswa_id', '=', 'mahasiswa.id')
                ->select('pengurus.*', 'mahasiswa.nama as nama_mhs')
                ->whereNull('pengurus.deleted_at')
                ->orderBy('mahasiswa.nama', 'asc')
                ->get();
        }

        return view('admin.absensi.form_absen', compact('kegiatan', 'daftarPengurus'));
    }

    public function submitAbsen(Request $request)
    {
        $request->validate(['nama' => 'required', 'token' => 'required']);
        $kegiatan = AbsensiModel::where('token_absensi', $request->token)->firstOrFail();

        $sudahAbsen = KehadiranModel::where('absensi_id', $kegiatan->id)
                                    ->where('nama', $request->nama)
                                    ->exists();

        if ($sudahAbsen) {
            return "Maaf, nama " . strtoupper($request->nama) . " sudah tercatat hadir.";
        }

        KehadiranModel::create([
            'absensi_id' => $kegiatan->id,
            'nama'       => strtoupper($request->nama)
        ]);

        return "Berhasil! Kehadiran " . strtoupper($request->nama) . " telah dicatat. Terima kasih!";
    }
}
