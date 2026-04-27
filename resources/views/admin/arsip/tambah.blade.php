@extends('admin.layouts.admin')

@section('content')
{{-- space-y-4 agar tetap satu layar --}}
<form action="#" method="POST" enctype="multipart/form-data" class="space-y-4 animate-in fade-in duration-500">
    @csrf
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.arsip.index') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Tambah Dokumen</h1>
        </div>
        <button type="submit" class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-[#0a362d]/20 active:scale-95 transition-all">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Arsip
        </button>
    </div>

    {{-- Informasi Dokumen (Grid 2 Kolom) --}}
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm space-y-5">
        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Meta Data Dokumen</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
            <div class="md:col-span-2">
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Nama Dokumen</label>
                <input type="text" name="nama_dokumen" placeholder="Contoh: Surat Peminjaman Lab..." class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
            </div>
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Kategori</label>
                <input type="text" name="kategori" placeholder="Contoh: Surat / Proposal" class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
            </div>
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Tanggal Arsip</label>
                <input type="date" name="tgl_upload" class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all">
            </div>
        </div>
    </div>

    {{-- Upload Area (Compact) --}}
    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm space-y-4">
        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">File Dokumen</p>
        <label class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-[1.5rem] cursor-pointer hover:bg-gray-50 transition-all group overflow-hidden">
            <div class="flex flex-col items-center justify-center">
                <i class="fa-solid fa-file-pdf text-2xl text-gray-300 group-hover:text-[#0a362d] mb-2 transition-colors"></i>
                <p class="text-[10px] font-black text-[#0a362d] uppercase tracking-widest">Klik untuk pilih file</p>
                <p class="text-[8px] text-gray-400 mt-1 uppercase italic">PDF, DOCX, ZIP (MAX 10MB)</p>
            </div>
            <input type="file" name="file_dokumen" class="hidden" />
        </label>
    </div>
</form>
@endsection
