@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto animate-in fade-in duration-500 overflow-hidden">
    <form action="{{ route('admin.database.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Edit Data Pengurus</h2>
                <span class="bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-amber-100">
                    ID Anggota: #{{ $pengurus->id }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-5">
                <div class="md:col-span-1 space-y-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-center">Foto Profil</label>
                    <div class="relative group w-full aspect-square rounded-2xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center">
                        <img id="previewFoto"
                             src="{{ $pengurus->mahasiswa->foto ? asset('storage/' . $pengurus->mahasiswa->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($pengurus->mahasiswa->nama) . '&background=0a362d&color=fff' }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i class="fa-solid fa-camera text-white text-xl"></i>
                        </div>
                        <input type="file" name="foto" onchange="previewImage(event)" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    <p class="text-[8px] text-gray-400 text-center italic font-medium uppercase leading-none mt-2">Maks. 2MB (JPG/PNG)</p>
                </div>

                <div class="md:col-span-2 grid grid-cols-2 gap-x-4 gap-y-4">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $pengurus->mahasiswa->nama) }}" required
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $pengurus->mahasiswa->nim) }}" required
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Angkatan</label>
                        <input type="number" name="angkatan" value="{{ old('angkatan', $pengurus->angkatan) }}" required
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                    </div>

                    <div class="relative">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jabatan</label>
                        <select name="jabatan" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer text-[#0a362d] uppercase">
                            @foreach(['KETUA', 'WAKIL KETUA', 'SEKRETARIS', 'BENDAHARA', 'KEPALA DIVISI', 'ANGGOTA'] as $jab)
                                <option value="{{ $jab }}" {{ old('jabatan', $pengurus->jabatan) == $jab ? 'selected' : '' }}>{{ $jab }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-[42px] pointer-events-none opacity-30"><i class="fa-solid fa-chevron-down text-[10px]"></i></div>
                    </div>

                    <div class="relative">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Divisi</label>
                        <select name="divisi" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer text-[#0a362d] uppercase">
                            @foreach(['BADAN PENGURUS HARIAN', 'DIVISI KOMINFO', 'DIVISI HUMAS', 'DIVISI WEB', 'DIVISI UI/UX', 'DIVISI MOBILE', 'DIVISI DATA', 'DIVISI DEVOPS'] as $div)
                                <option value="{{ $div }}" {{ old('divisi', $pengurus->divisi) == $div ? 'selected' : '' }}>{{ $div }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-6 top-[42px] pointer-events-none opacity-30"><i class="fa-solid fa-chevron-down text-[10px]"></i></div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Instagram (Optional)</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $pengurus->mahasiswa->instagram) }}"
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]" placeholder="USERNAME">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-3 border-t border-gray-50 pt-6">
                <button type="submit" class="bg-[#0a362d] text-white px-10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-[#0a362d]/10 active:scale-95">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.database.index') }}" class="bg-gray-100 text-gray-400 px-10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all text-center flex items-center justify-center">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('previewFoto').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
