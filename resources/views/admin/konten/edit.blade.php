@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto animate-in fade-in duration-500 overflow-hidden">
    <form action="{{ route('admin.konten.update', $konten->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Edit Konten</h2>
                <span class="bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-amber-100">
                    ID Konten: #{{ $konten->id }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Judul Konten</label>
                    <input type="text" name="judul" value="{{ old('judul', $konten->judul) }}" required
                           class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase">
                </div>

                <div class="relative">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kategori</label>
                    <select name="kategori" id="kategoriSelect" onchange="toggleSubJudul()" required
                            class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer text-[#0a362d] uppercase">
                        <option value="Proker" {{ old('kategori', $konten->kategori) == 'Proker' ? 'selected' : '' }} class="uppercase">PROGRAM KERJA</option>
                        <option value="Prestasi" {{ old('kategori', $konten->kategori) == 'Prestasi' ? 'selected' : '' }} class="uppercase">PRESTASI</option>
                    </select>
                    <div class="absolute right-6 top-[42px] pointer-events-none opacity-30">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                <div id="wrapperSubJudul" class="animate-in fade-in zoom-in duration-300">
                    <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2">Sub Judul (Khusus Prestasi)</label>
                    <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul', $konten->sub_judul) }}"
                           class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase" placeholder="KATEGORI LOMBA">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Ganti Foto Thumbnail</label>
                    <input type="file" name="gambar" class="w-full bg-gray-50 border-none py-2 px-6 rounded-2xl text-[10px] font-bold file:mr-4 file:py-1.5 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-[#0a362d] file:text-white uppercase">
                </div>

                @if($konten->gambar)
                <div class="col-span-1 flex items-center gap-4">
                    <p class="text-[9px] font-black text-gray-300 uppercase italic">Thumbnail Saat Ini:</p>
                    <div class="w-20 h-12 rounded-xl overflow-hidden border-2 border-gray-50 shadow-sm">
                        <img src="{{ asset('storage/' . $konten->gambar) }}" class="w-full h-full object-cover">
                    </div>
                </div>
                @endif

                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Isi Konten Utama</label>
                    <textarea name="isi" rows="4" required class="w-full bg-gray-50 border-none py-4 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 text-[#0a362d] uppercase no-scrollbar">{{ old('isi', $konten->isi) }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex gap-3 border-t border-gray-50 pt-6">
                <button type="submit" class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-gray-100 active:scale-95">
                    Update Konten
                </button>
                <a href="{{ route('admin.konten.index') }}" class="bg-gray-100 text-gray-400 px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all text-center flex items-center justify-center">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleSubJudul() {
        const kategori = document.getElementById('kategoriSelect').value;
        const wrapper = document.getElementById('wrapperSubJudul');
        const input = document.getElementById('sub_judul');

        if (kategori === 'Prestasi') {
            wrapper.style.display = 'block';
        } else {
            wrapper.style.display = 'none';
            input.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleSubJudul();
    });
</script>
@endsection
