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

<form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pb-10 animate-in fade-in duration-500">
    @csrf

    <div class="flex items-center justify-between px-2">
        <div class="flex flex-col text-left">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Tambah Arsip Dokumen</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Unggah berkas dokumen baru ke server PROTIC</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.arsip.index') }}" class="bg-gray-100 text-gray-500 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20">
                <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Arsip
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1 space-y-4">
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm text-center relative overflow-hidden">
                <i class="fa-solid fa-box-archive absolute -right-4 -top-4 text-6xl text-gray-50/50"></i>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-4">File Dokumen</label>

                <div class="relative w-40 h-40 mx-auto mb-4">
                    <div id="filePreviewContainer" class="w-full h-full rounded-[2rem] bg-emerald-50/30 border-2 border-dashed border-emerald-100 flex flex-col items-center justify-center overflow-hidden transition-all duration-500">
                        <i id="fileIcon" class="fa-solid fa-file-circle-plus text-5xl text-emerald-200 animate-pulse"></i>
                        <div id="fileInfo" class="hidden px-4 text-center">
                            <i id="typeIcon" class="fa-solid fa-file-pdf text-3xl mb-2 text-emerald-600"></i>
                            <p id="fileNameLabel" class="text-[8px] font-black text-[#0a362d] uppercase break-all line-clamp-2"></p>
                            <p id="fileSizeLabel" class="text-[7px] font-bold text-emerald-600 mt-1"></p>
                        </div>
                    </div>
                </div>

                <label class="inline-block bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-pointer transition-all hover:scale-105 active:scale-95 shadow-md">
                    Cari File
                    <input type="file" name="file_dokumen" id="fileInput" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx" onchange="previewFileStatus()">
                </label>
            </div>
        </div>

        <div class="md:col-span-2 space-y-4">
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm grid grid-cols-2 gap-6 uppercase text-left">
                <div class="col-span-2 text-left">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" value="{{ old('nama_dokumen') }}" required
                        class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase placeholder:text-gray-300"
                        placeholder="CONTOH: LAPORAN PERTANGGUNGJAWABAN PESTAPORA" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="text-left">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Kategori</label>
                    <div class="relative">
                        <select name="kategori" required class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none appearance-none cursor-pointer hover:border-amber-500 transition-all uppercase">
                            <option value="" disabled selected>PILIH KATEGORI</option>
                            <option value="SURAT">SURAT MENYURAT</option>
                            <option value="NOTULENSI">NOTULENSI KEGIATAN</option>
                            <option value="LAINNYA">DOKUMEN LAINNYA</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-gray-300 text-[10px]"></i>
                    </div>
                </div>

                <div class="text-left">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Tanggal Dokumen</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                        class="w-full bg-gray-50 border border-gray-100 py-3.5 px-5 rounded-2xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase">
                </div>

                <div class="col-span-2 text-left">
                    <label class="block text-[11px] font-black text-[#0a362d] tracking-widest mb-2 ml-1">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full bg-gray-50 border border-gray-100 py-4 px-5 rounded-[2rem] text-xs font-bold focus:outline-none focus:border-amber-500 transition-all uppercase resize-none"
                        placeholder="MASUKKAN KETERANGAN JIKA ADA..." oninput="this.value = this.value.toUpperCase()">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function previewFileStatus() {
        const input = document.getElementById('fileInput');
        const icon = document.getElementById('fileIcon');
        const info = document.getElementById('fileInfo');
        const label = document.getElementById('fileNameLabel');
        const sizeLabel = document.getElementById('fileSizeLabel');
        const container = document.getElementById('filePreviewContainer');
        const typeIcon = document.getElementById('typeIcon');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const size = (file.size / 1024 / 1024).toFixed(2);
            icon.classList.add('hidden');
            info.classList.remove('hidden');
            label.innerText = file.name;
            sizeLabel.innerText = size + " MB";
            container.classList.remove('bg-emerald-50/30', 'border-emerald-100');
            container.classList.add('bg-emerald-50', 'border-emerald-500', 'shadow-inner');

            if(file.name.includes('.pdf')) typeIcon.className = "fa-solid fa-file-pdf text-3xl mb-2 text-rose-500";
            else if(file.name.includes('.doc')) typeIcon.className = "fa-solid fa-file-word text-3xl mb-2 text-blue-500";
            else if(file.name.includes('.xls')) typeIcon.className = "fa-solid fa-file-excel text-3xl mb-2 text-emerald-600";
        }
    }
</script>
@endsection
