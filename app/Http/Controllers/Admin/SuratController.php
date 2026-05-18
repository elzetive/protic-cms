<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratModel;

class SuratController extends Controller
{
    public function create()
    {
        return view('admin.arsip.tambah_surat');
    }

    public function storeAndPrint(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'hal' => 'required',
            'tujuan' => 'required',
            'agenda_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'nama_ketua' => 'required',
            'nim_ketua' => 'required',
            'nama_pembina' => 'required',
            'nip_pembina' => 'required',
        ]);

        SuratModel::create([
            'nomor_surat'      => $request->nomor_surat,
            'hal'              => $request->hal,
            'tujuan'           => $request->tujuan,
            'agenda_kegiatan'  => $request->agenda_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_kegiatan'   => $request->waktu_kegiatan,
            'tempat_kegiatan'  => $request->tempat_kegiatan,
            'nama_ketua'       => $request->nama_ketua,
            'nim_ketua'        => $request->nim_ketua,
            'nama_pembina'     => $request->nama_pembina,
            'nip_pembina'      => $request->nip_pembina,
        ]);

        $data = $request->all();

        return view('admin.arsip.template_surat', compact('data'));
    }
}
