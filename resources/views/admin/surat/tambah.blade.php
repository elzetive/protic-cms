@extends('admin.layouts.admin')

@section('content')
@if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
        <p class="text-[10px] font-black text-red-600 uppercase tracking-widest">Terjadi Kesalahan:</p>
        <ul class="mt-1 list-disc list-inside text-[10px] text-red-500 font-bold uppercase tracking-tight">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.surat.store') }}" method="POST" class="space-y-4 pb-10 animate-in fade-in duration-500">
    @csrf

    <div class="flex items-center justify-between px-2">
        <div class="flex flex-col text-left">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Buat Surat Resmi Baru</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Auto-generator cetak lembar surat dinamis UKM PROTIC PNC</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.surat.index') }}" class="bg-gray-100 text-gray-500 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20">
                <i class="fa-solid fa-print"></i> Simpan
            </button>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6 uppercase text-left">

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Nomor Surat</label>
            <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: 095/PM/PROTIC/V/2026">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Perihal (Hal)</label>
            <input type="text" name="hal" value="{{ old('hal') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Peminjaman Tempat dan Perlengkapan">
        </div>

        <div class="text-left col-span-2">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Tujuan Surat / Jabatan Intansi</label>
            <input type="text" name="tujuan" value="{{ old('tujuan') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Kepala Subbagian Akademik">
        </div>

        <div class="text-left col-span-2">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Nama / Agenda Kegiatan Utama</label>
            <input type="text" name="agenda_kegiatan" value="{{ old('agenda_kegiatan') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Rapat Rutinan oleh Unit Kegiatan Mahasiswa PROTIC">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Hari & Tanggal Pelaksanaan</label>
            <input type="text" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Kamis, 21 Mei 2026">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Waktu / Jam Kegiatan</label>
            <input type="text" name="waktu_kegiatan" value="{{ old('waktu_kegiatan') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: 16.00 WIB s.d Selesai">
        </div>

        <div class="text-left col-span-2">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Tempat / Ruang Pelaksanaan</label>
            <input type="text" name="tempat_kegiatan" value="{{ old('tempat_kegiatan') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Ruang I.2.1 dan I.2.2, Gedung Kuliah Bersama, Politeknik Negeri Cilacap">
        </div>

        <div class="col-span-2 border-t border-dashed border-gray-100 my-2"></div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Nama Pembina UKM</label>
            <input type="text" name="nama_pembina" value="{{ old('nama_pembina') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Rahmawan Bagus Trianto, S.Kom., M.Kom">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">NIP Pembina</label>
            <input type="text" name="nip_pembina" value="{{ old('nip_pembina') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: 199112012024061001">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Nama Ketua UKM</label>
            <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: Ilham Budi Trisetyo">
        </div>

        <div class="text-left col-span-1">
            <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">NIM Ketua</label>
            <input type="text" name="nim_ketua" value="{{ old('nim_ketua') }}" required
                class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300"
                placeholder="CONTOH: 24.03.02.017">
        </div>

    </div>
</form>
@endsection
