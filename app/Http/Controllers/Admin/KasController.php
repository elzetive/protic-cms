<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KasController extends Controller
{
    public function indexTransaksi()
    {
        $transaksi = KasModel::where('kategori', '!=', 'Iuran')->latest()->get();

        $totalMasuk = KasModel::where('tipe', 'Masuk')->sum('nominal');
        $totalKeluar = KasModel::where('tipe', 'Keluar')->sum('nominal');
        $saldoSisa = $totalMasuk - $totalKeluar;

        return view('admin.kas.transaksi.index', compact('transaksi', 'totalMasuk', 'totalKeluar', 'saldoSisa'));
    }

public function indexIuran()
{
    $iuran = KasModel::where('kategori', 'Iuran')->latest()->get();

    $daftarPengurus = \App\Models\PengurusModel::orderBy('nama', 'asc')->get();

    return view('admin.kas.iuran.index', compact('iuran', 'daftarPengurus'));
}
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'bukti' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('uploads/kas', 'public');
        }

        KasModel::create($data);

        return redirect()->back()->with('success', 'TRANSAKSI BERHASIL DICATAT!');
    }

    public function destroy($id)
    {
        $kas = KasModel::findOrFail($id);
        if ($kas->bukti) {
            Storage::disk('public')->delete($kas->bukti);
        }
        $kas->delete();
        return redirect()->back()->with('success', 'CATATAN KAS BERHASIL DIHAPUS!');
    }
}
