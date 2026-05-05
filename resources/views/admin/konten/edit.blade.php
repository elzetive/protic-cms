@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto animate-in fade-in duration-500">
    <form action="{{ route('admin.konten.update', $konten->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT') {{-- WAJIB ADA BUAT UPDATE --}}

        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Edit Data Rekap</h2>
                <span class="bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-amber-100">
                    ID Rekap: #{{ $konten->id }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- JUDUL --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $konten->judul) }}" required
                           class="w-full bg-gray-50 border-none py-4 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase">
                </div>
                <div>
    <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5">Sub Judul</label>
    <input type="text" name="sub_judul" value="{{ old('sub_judul', $konten->sub_judul ?? '') }}" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase" placeholder="CONTOH: LOMBA WEB DESIGN NASIONAL">
</div>

                {{-- KATEGORI --}}
                <div class="relative">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Kategori</label>
                    <select name="kategori" required class="w-full bg-gray-50 border-none py-4 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer text-[#0a362d] uppercase">
                        <option value="Proker" {{ $konten->kategori == 'Proker' ? 'selected' : '' }} class="uppercase">PROGRAM KERJA</option>
                        <option value="Prestasi" {{ $konten->kategori == 'Prestasi' ? 'selected' : '' }} class="uppercase">PRESTASI</option>
                    </select>
                    <div class="absolute right-6 top-[52px] pointer-events-none opacity-30">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                {{-- GAMBAR --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Ganti Foto (Kosongkan jika tetap)</label>
                    <input type="file" name="gambar" class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-[10px] font-bold file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#0a362d] file:text-white uppercase">
                </div>

                {{-- PREVIEW GAMBAR LAMA --}}
                @if($konten->gambar)
                <div class="col-span-2">
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-3 italic">Foto saat ini:</p>
                    <div class="w-32 h-20 rounded-2xl overflow-hidden border-4 border-gray-50 shadow-sm">
                        <img src="{{ asset('storage/' . $konten->gambar) }}" class="w-full h-full object-cover">
                    </div>
                </div>
                @endif

                {{-- ISI --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Isi Rekapitulasi</label>
                    <textarea name="isi" rows="6" required class="w-full bg-gray-50 border-none py-4 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 text-[#0a362d] uppercase">{{ old('isi', $konten->isi) }}</textarea>
                </div>
            </div>

            <div class="mt-10 flex gap-4 border-t border-gray-50 pt-10">
                <button type="submit" class="bg-[#0a362d] text-white px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-gray-100">Update Data</button>
                <a href="{{ route('admin.konten.index') }}" class="bg-gray-100 text-gray-400 px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection
