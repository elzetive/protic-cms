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

<form action="{{ route('admin.konten.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pb-2 animate-in fade-in duration-500">
    @csrf

    <div class="flex items-center justify-between">
        <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Buat Konten Baru</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.konten.index') }}" class="bg-gray-100 text-gray-500 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20">
                <i class="fa-solid fa-paper-plane"></i> Publish Konten
            </button>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5">Judul Konten</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full bg-gray-50 border border-gray-100 py-2.5 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase placeholder:uppercase" placeholder="Masukkan judul konten...">
            </div>

            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5">Kategori</label>
                <div class="relative">
                    <select name="kategori" id="kategoriSelect" onchange="toggleSubJudul()" required class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[11px] font-bold focus:outline-none appearance-none cursor-pointer uppercase">
                        <option value="" disabled selected class="uppercase">Pilih Kategori</option>
                        <option value="Proker" {{ old('kategori') == 'Proker' ? 'selected' : '' }} class="uppercase">PROKER</option>
                        <option value="Prestasi" {{ old('kategori') == 'Prestasi' ? 'selected' : '' }} class="uppercase">PRESTASI</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none opacity-40">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>

            <div id="wrapperSubJudul" class="hidden animate-in fade-in zoom-in duration-300">
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5">Sub Judul </label>
                <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul') }}" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase" placeholder="KATEGORI LOMBA ">
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5">Isi Konten</label>
            <textarea name="isi" rows="6" required class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all resize-none placeholder:uppercase" placeholder="Tuliskan isi konten di sini...">{{ old('isi') }}</textarea>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
             <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-3">Upload Thumbnail</label>
             <label class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-[1.5rem] cursor-pointer hover:bg-gray-50 transition-all group">
                <div class="flex flex-col items-center justify-center text-center px-4">
                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-gray-300 group-hover:text-[#0a362d] mb-2"></i>
                    <p class="text-[10px] font-black text-[#0a362d] uppercase tracking-wider">Klik untuk pilih gambar</p>
                    <p id="fileName" class="text-[9px] text-amber-600 font-bold mt-1 uppercase italic truncate max-w-xs"></p>
                </div>
                <input type="file" name="gambar" id="gambarInput" class="hidden" accept="image/*" onchange="displayFileName()" />
            </label>
        </div>

        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2">Penulis (Author)</label>
                    <div class="flex items-center gap-3 bg-gray-50 py-2.5 px-4 rounded-xl border border-gray-100">
                        <div class="w-6 h-6 bg-[#0a362d] rounded-lg flex items-center justify-center text-white text-[10px] font-black uppercase">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <input type="text" name="penulis" class="bg-transparent border-none text-[11px] font-bold text-gray-600 outline-none w-full uppercase"
                               value="{{ Auth::user()->name ?? 'GUEST' }}" readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2">Informasi Sistem</label>
                    <div class="bg-amber-50/50 p-3 rounded-xl border border-amber-100">
                        <p class="text-[9px] text-amber-800 italic font-medium leading-relaxed uppercase">
                            * Login sebagai: {{ Auth::user()->email ?? '-' }}<br>
                            * Pastikan gambar berformat JPG/PNG max 2MB.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleSubJudul() {
        const kategori = document.getElementById('kategoriSelect').value;
        const wrapper = document.getElementById('wrapperSubJudul');
        const input = document.getElementById('sub_judul');

        if (kategori === 'Prestasi') {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
            input.value = '';
        }
    }

    window.onload = toggleSubJudul;

    function displayFileName() {
        const input = document.getElementById('gambarInput');
        const fileName = document.getElementById('fileName');
        if (input.files.length > 0) {
            fileName.textContent = "FILE TERPILIH: " + input.files[0].name.toUpperCase();
        }
    }
</script>
@endsection
