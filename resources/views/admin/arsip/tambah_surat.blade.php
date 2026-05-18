@extends('admin.layouts.admin')

@section('content')
<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden text-left">

    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Buat Surat Dokumen</h1>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 italic">
                Arsip &rarr; Pembuat Surat Peminjaman Otomatis
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.arsip.index') }}"
               class="bg-gray-50 text-gray-500 hover:bg-gray-100 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 border border-gray-200/60 transition-all shadow-sm active:scale-95">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col flex-1 min-h-0 overflow-hidden">

        <div class="px-6 border-b border-gray-50 flex items-center justify-between bg-gray-50/20 shrink-0">
            <div class="flex gap-2 pt-3">
                <button type="button" onclick="switchTab('inti-surat')" id="btn-inti-surat" class="px-5 py-2.5 border-b-2 border-[#0a362d] text-[#0a362d] text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none">
                    <i class="fa-solid fa-file-lines mr-2"></i> 1. Bagian Inti Surat
                </button>
                <button type="button" onclick="switchTab('struktural')" id="btn-struktural" class="px-5 py-2.5 border-b-2 border-transparent text-gray-400 hover:text-gray-600 text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none">
                    <i class="fa-solid fa-signature mr-2"></i> 2. Penandatangan & TTD
                </button>
            </div>
            <h4 class="font-black text-[#0a362d]/40 uppercase text-[9px] tracking-[0.2em] hidden sm:block">
                Formulir Surat Dinamis
            </h4>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar p-6 md:p-8">
            <form action="{{ route('admin.arsip.surat.proses') }}" method="POST" target="_blank" class="max-w-3xl mx-auto">
                @csrf

                <div id="tab-inti-surat" class="space-y-6 block">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Nomor Surat</label>
                            <input type="text" name="nomor_surat" value="095/PM/PROTIC/V/2026"
                                   class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Perihal (Hal)</label>
                            <input type="text" name="hal" value="Peminjaman Tempat dan Perlengkapan"
                                   class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Kepada Yth. (Tujuan Surat)</label>
                        <input type="text" name="tujuan" value="Kepala Subbagian Akademik Politeknik Negeri Cilacap"
                               class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Agenda / Alasan Peminjaman</label>
                        <input type="text" name="agenda_kegiatan" value="Rapat Rutinan oleh Unit Kegiatan Mahasiswa PROTIC"
                               class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Hari, Tanggal</label>
                            <input type="text" name="tanggal_kegiatan" value="Kamis, 21 Mei 2026"
                                   class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Waktu Pelaksanaan</label>
                            <input type="text" name="waktu_kegiatan" value="16.00 WIB s.d Selesai"
                                   class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Tempat / Ruangan</label>
                            <input type="text" name="tempat_kegiatan" value="Ruang I.2.1 dan I.2.2, Gedung Kuliah Bersama, Politeknik Negeri Cilacap"
                                   class="w-full px-5 py-3 rounded-2xl bg-gray-50/60 border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-50 transition-all" required>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="switchTab('struktural')" class="bg-[#0a362d]/5 text-[#0a362d] border border-[#0a362d]/10 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#0a362d] hover:text-white transition-all active:scale-95">
                            Lanjut Bagian TTD &rarr;
                        </button>
                    </div>
                </div>

                <div id="tab-struktural" class="space-y-6 hidden animate-in fade-in duration-300">

                    <div class="bg-gray-50/30 border border-gray-100 p-6 rounded-2xl space-y-4">
                        <div class="text-[10px] font-black uppercase text-[#f59e0b] tracking-wider mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-user-graduate"></i> Akreditasi Ketua Organisasi
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Nama Ketua PROTIC</label>
                                <input type="text" name="nama_ketua" value="Ilham Budi Trisetvo"
                                       class="w-full px-5 py-3 rounded-2xl bg-white border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-50 transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">NIM Ketua</label>
                                <input type="text" name="nim_ketua" value="24.03.02.017"
                                       class="w-full px-5 py-3 rounded-2xl bg-white border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-50 transition-all" required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/30 border border-gray-100 p-6 rounded-2xl space-y-4">
                        <div class="text-[10px] font-black uppercase text-[#f59e0b] tracking-wider mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-user-tie"></i> Akreditasi Pembina / Dosen
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">Nama Pembina PROTIC</label>
                                <input type="text" name="nama_pembina" value="Rahmawan Bagus Trianto, S.Kom., M.Kom"
                                       class="w-full px-5 py-3 rounded-2xl bg-white border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-50 transition-all" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-[0.15em]">NIP Pembina</label>
                                <input type="text" name="nip_pembina" value="199112012024061001"
                                       class="w-full px-5 py-3 rounded-2xl bg-white border border-gray-100 font-bold text-[11px] text-[#0a362d] uppercase tracking-wide focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-50 transition-all" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <button type="button" onclick="switchTab('inti-surat')" class="text-gray-400 hover:text-[#0a362d] text-[10px] font-black uppercase tracking-widest transition-all">
                            &larr; Kembali Ke Inti
                        </button>
                        <button type="submit"
                                class="bg-[#0a362d] text-white px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2.5 hover:bg-amber-600 transition-all shadow-md shadow-[#0a362d]/10 active:scale-95">
                            <i class="fa-solid fa-print text-xs"></i> Simpan Ke Arsip & Cetak
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        const tabInti = document.getElementById('tab-inti-surat');
        const tabStruktural = document.getElementById('tab-struktural');
        const btnInti = document.getElementById('btn-inti-surat');
        const btnStruktural = document.getElementById('btn-struktural');

        if (tabName === 'inti-surat') {
            tabInti.classList.replace('hidden', 'block');
            tabStruktural.classList.replace('block', 'hidden');

            btnInti.className = "px-5 py-2.5 border-b-2 border-[#0a362d] text-[#0a362d] text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none";
            btnStruktural.className = "px-5 py-2.5 border-b-2 border-transparent text-gray-400 hover:text-gray-600 text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none";
        } else {
            tabInti.classList.replace('block', 'hidden');
            tabStruktural.classList.replace('hidden', 'block');

            btnInti.className = "px-5 py-2.5 border-b-2 border-transparent text-gray-400 hover:text-gray-600 text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none";
            btnStruktural.className = "px-5 py-2.5 border-b-2 border-[#0a362d] text-[#0a362d] text-[10px] font-black uppercase tracking-wider transition-all focus:outline-none";
        }
    }
</script>
@endsection
