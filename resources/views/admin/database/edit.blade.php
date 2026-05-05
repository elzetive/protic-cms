@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-500">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-10">
        <div class="flex flex-col">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Edit Data Pengurus</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Perbarui informasi identitas anggota PROTIC</p>
        </div>
        <a href="{{ route('admin.database.index') }}" class="bg-white border border-gray-200 text-[#0a362d] px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 active:scale-95 transition-all">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.database.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm sticky top-24">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 text-center">Foto Profil</p>
                    <div class="relative group w-full aspect-square rounded-2xl overflow-hidden border-2 border-dashed border-gray-200 mb-4 bg-gray-50 flex items-center justify-center">
                        <img id="previewFoto"
                             src="{{ $pengurus->foto ? asset('storage/' . $pengurus->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($pengurus->nama) . '&background=0a362d&color=fff' }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i class="fa-solid fa-camera text-white text-2xl"></i>
                        </div>
                        <input type="file" name="foto" onchange="previewImage(event)" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    <p class="text-[9px] text-gray-400 text-center italic font-medium">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}"
                                   class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-[#0a362d] outline-none transition-all uppercase" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim', $pengurus->nim) }}"
                                   class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-[#0a362d] outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Tahun Angkatan</label>
                            <input type="number" name="angkatan" value="{{ old('angkatan', $pengurus->angkatan) }}"
                                   class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-[#0a362d] outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Jabatan</label>
                            <select name="jabatan" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-[#0a362d] outline-none transition-all">
                                @php $jabatans = ['KETUA', 'WAKIL KETUA', 'SEKRETARIS', 'BENDAHARA', 'KEPALA DIVISI', 'ANGGOTA']; @endphp
                                @foreach($jabatans as $jab)
                                    <option value="{{ $jab }}" {{ old('jabatan', $pengurus->jabatan) == $jab ? 'selected' : '' }}>{{ $jab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Divisi</label>
                            <select name="divisi" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-[#0a362d] outline-none transition-all">
                                @php $divisis = ['BADAN PENGURUS HARIAN', 'DIVISI KOMINFO', 'DIVISI HUMAS', 'DIVISI WEB', 'DIVISI UI/UX', 'DIVISI MOBILE', 'DIVISI DATA', 'DIVISI DEVOPS']; @endphp
                                @foreach($divisis as $div)
                                    <option value="{{ $div }}" {{ old('divisi', $pengurus->divisi) == $div ? 'selected' : '' }}>{{ $div }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-gray-50">
                        <button type="submit" class="w-full bg-[#0a362d] text-white py-4 rounded-xl font-black uppercase tracking-[0.2em] text-[12px] hover:bg-[#082a23] shadow-lg shadow-[#0a362d]/20 transition-all active:scale-95">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
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
