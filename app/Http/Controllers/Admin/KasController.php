<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KasModel;
use App\Models\PengurusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KasController extends Controller
{
    public function indexTransaksi()
    {
        $transaksi = KasModel::whereNotIn('kategori', [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ])->latest()->get();

        $totalMasuk = KasModel::where('tipe', 'Masuk')->sum('nominal');
        $totalKeluar = KasModel::where('tipe', 'Keluar')->sum('nominal');
        $saldoSisa = $totalMasuk - $totalKeluar;

        return view('admin.kas.transaksi.index', compact('transaksi', 'totalMasuk', 'totalKeluar', 'saldoSisa'));
    }

    public function indexIuran()
    {
        $iuran = KasModel::whereIn('kategori', [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ])->get();

        $daftarPengurus = PengurusModel::with('mahasiswa')
            ->get()
            ->map(function($p) {
                return [
                    'nama' => $p->mahasiswa->nama,
                    'angkatan' => $p->angkatan,
                    'jabatan' => $p->jabatan,
                    'divisi' => $p->divisi,
                    'nim' => $p->mahasiswa->nim
                ];
            });

        return view('admin.kas.iuran.index', compact('iuran', 'daftarPengurus'));
    }

    public function detailIuran($periode, $bulan)
    {
        $dataIuran = KasModel::where('kategori', $bulan)
            ->where('periode', $periode)
            ->latest()
            ->get();

        return view('admin.kas.iuran.detail', compact('dataIuran', 'bulan', 'periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori'   => 'required|string',
            'tipe'       => 'required|in:Masuk,Keluar',
            'periode'    => 'required',
            'nominal'    => 'required|numeric',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
            'bukti'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $isDuplicate = KasModel::where('kategori', $request->kategori)
            ->where('nominal', $request->nominal)
            ->where('tanggal', $request->tanggal)
            ->where('keterangan', $request->keterangan)
            ->exists();

        if ($isDuplicate) {
            return redirect()->back()->withErrors(['msg' => 'Data ini sudah pernah diinput sebelumnya.']);
        }

        $data = $request->all();
        $data['keterangan'] = strtoupper($request->keterangan ?? '-');

        $data['kategori'] = $request->kategori;

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti_kas', 'public');
        }

        KasModel::create($data);

        return redirect()->back()->with('success', 'Data Berhasil Dicatat!');
    }

    public function show($id)
    {
        $kas = KasModel::findOrFail($id);
        return view('admin.kas.transaksi.detail', compact('kas'));
    }

    public function update(Request $request, $id)
    {
        $kas = KasModel::findOrFail($id);

        $request->validate([
            'kategori'   => 'required',
            'nominal'    => 'required|numeric',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable',
            'periode'    => 'required',
            'bukti'      => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['keterangan'] = strtoupper($request->keterangan ?? '-');

        if ($request->hasFile('bukti')) {
            if ($kas->bukti) {
                Storage::disk('public')->delete($kas->bukti);
            }
            $data['bukti'] = $request->file('bukti')->store('bukti_kas', 'public');
        }

        $kas->update($data);

        return redirect()->route('admin.kas.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kas = KasModel::findOrFail($id);
        if ($kas->bukti) {
            Storage::disk('public')->delete($kas->bukti);
        }
        $kas->delete();

        return redirect()->back()->with('success', 'Catatan Berhasil Dihapus!');
    }

    public function showIuran($nama)
{
    $riwayat = KasModel::where('keterangan', $nama)
        ->whereIn('kategori', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'])
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('admin.kas.iuran.detail', compact('riwayat', 'nama'));
}
}
