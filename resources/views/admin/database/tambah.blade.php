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

<form action="{{ route('admin.database.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pb-10 animate-in fade-in duration-500">
    @csrf

    <div class="flex items-center justify-between">
        <div class="flex flex-col">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Tambah Pengurus</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Input data anggota baru PROTIC</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.database.index') }}" class="bg-gray-100 text-gray-500 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20">
                <i class="fa-solid fa-check"></i> Simpan Data
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm text-center">
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-4">Foto Profil</label>

                <div class="relative w-40 h-40 mx-auto mb-4">
                    <div id="previewContainer" class="w-full h-full rounded-[2rem] bg-gray-50 border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                        <i id="previewIcon" class="fa-solid fa-user text-5xl text-gray-200"></i>
                        <img id="imagePreview" class="hidden w-full h-full object-cover">
                    </div>
                </div>

                <label class="inline-block bg-gray-50 hover:bg-amber-50 text-[#0a362d] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-gray-100 cursor-pointer transition-all">
                    Pilih Foto
                    <input type="file" name="foto" id="fotoInput" class="hidden" accept="image/*" onchange="previewFile()">
                </label>
                <p class="text-[9px] text-gray-400 mt-3 italic">* JPG/PNG, MAKS 2MB</p>
            </div>
        </div>

        <div class="md:col-span-2 space-y-4">
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm grid grid-cols-2 gap-6 uppercase">

                <div class="col-span-2">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase"
                        placeholder="NAMA LENGKAP" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div>
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required
                        class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase"
                        placeholder="NOMOR INDUK MAHASISWA" oninput="this.value = this.value.toUpperCase()">
                </div>

<div>
    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">Periode</label>
    <select name="angkatan" required class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl text-xs font-bold focus:outline-none appearance-none cursor-pointer hover:border-amber-500 transition-colors uppercase">
        @php
            $currentYear = date('Y');
            $startYear = $currentYear;
            $endYear = $currentYear - 4;
        @endphp

        @for($y = $startYear; $y >= $endYear; $y--)
            @php $nextYear = $y + 1; @endphp
            <option value="{{ $y }}" {{ old('angkatan') == $y ? 'selected' : '' }}>
                {{ $y }}/{{ $nextYear }}
            </option>
        @endfor
    </select>
</div>                <div>
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">Divisi</label>
                    <select name="divisi" id="divisiSelect" required class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl text-xs font-bold focus:outline-none appearance-none cursor-pointer hover:border-amber-500 transition-all uppercase" onchange="updateJabatan()">
                        <option value="" disabled selected>PILIH DIVISI</option>
                        <option value="BADAN PENGURUS HARIAN" {{ old('divisi') == 'BADAN PENGURUS HARIAN' ? 'selected' : '' }}>BADAN PENGURUS HARIAN</option>
                        <option value="DIVISI KOMINFO" {{ old('divisi') == 'DIVISI KOMINFO' ? 'selected' : '' }}>DIVISI KOMINFO</option>
                        <option value="DIVISI HUMAS" {{ old('divisi') == 'DIVISI HUMAS' ? 'selected' : '' }}>DIVISI HUMAS</option>
                        <option value="DIVISI WEB" {{ old('divisi') == 'DIVISI WEB' ? 'selected' : '' }}>DIVISI WEB</option>
                        <option value="DIVISI UI/UX" {{ old('divisi') == 'DIVISI UI/UX' ? 'selected' : '' }}>DIVISI UI/UX</option>
                        <option value="DIVISI MOBILE" {{ old('divisi') == 'DIVISI MOBILE' ? 'selected' : '' }}>DIVISI MOBILE</option>
                        <option value="DIVISI DATA" {{ old('divisi') == 'DIVISI DATA' ? 'selected' : '' }}>DIVISI DATA</option>
                        <option value="DIVISI DEVOPS" {{ old('divisi') == 'DIVISI DEVOPS' ? 'selected' : '' }}>DIVISI DEVOPS</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">Jabatan</label>
                    <select name="jabatan" id="jabatanSelect" required class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl text-xs font-bold focus:outline-none appearance-none cursor-pointer hover:border-amber-500 transition-all uppercase">
                        <option value="" disabled selected>PILIH JABATAN</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2">Instagram (optional)</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-100 py-3 px-5 rounded-2xl">
                        <span class="text-gray-400 text-sm font-bold">@</span>
                        <input type="text" name="instagram" value="{{ old('instagram') }}"
                            class="w-full bg-transparent border-none outline-none text-xs font-bold uppercase"
                            placeholder="USERNAME IG" oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<script>
    function previewFile() {
        const preview = document.getElementById('imagePreview');
        const icon = document.getElementById('previewIcon');
        const file = document.getElementById('fotoInput').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        }
        if (file) { reader.readAsDataURL(file); }
    }

    function updateJabatan() {
        const divisi = document.getElementById('divisiSelect').value;
        const jabatanSelect = document.getElementById('jabatanSelect');
        jabatanSelect.innerHTML = '';

        const bphOptions = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'];
        const divisiOptions = ['Kepala Divisi', 'Anggota'];
        let selectedOptions = (divisi === 'BADAN PENGURUS HARIAN') ? bphOptions : divisiOptions;

        const defaultOption = document.createElement('option');
        defaultOption.value = ""; defaultOption.disabled = true; defaultOption.selected = true;
        defaultOption.text = "PILIH JABATAN";
        jabatanSelect.appendChild(defaultOption);

        selectedOptions.forEach(opt => {
            const el = document.createElement('option');
            el.value = opt.toUpperCase();
            el.text = opt.toUpperCase();
            jabatanSelect.appendChild(el);
        });
    }

    window.onload = function() {
        if(document.getElementById('divisiSelect').value !== "") { updateJabatan(); }
    };
</script>
@endsection
