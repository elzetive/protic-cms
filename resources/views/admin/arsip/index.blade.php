@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Arsip Dokumen</h1>
        <a href="{{ route('admin.arsip.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95">
            <i class="fa-solid fa-plus text-[10px]"></i> TAMBAH ARSIP
        </a>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5">Nama Dokumen</th>
                        <th class="px-8 py-5">Kategori</th>
                        <th class="px-8 py-5">Ukuran</th>
                        <th class="px-8 py-5">Tgl Upload</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    {{-- LIMIT DATA: 6 Baris agar no-scroll --}}
                    @for ($i = 0; $i < 6; $i++)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-4">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-pdf text-red-400 text-base"></i>
                                <span class="uppercase tracking-tighter">Surat Peminjaman Ruangan</span>
                            </div>
                        </td>
                        <td class="px-8 py-4">
                            <span class="text-gray-400 uppercase text-[9px] tracking-widest bg-gray-50 px-2 py-1 rounded">Surat</span>
                        </td>
                        <td class="px-8 py-4 text-gray-400 font-medium tracking-widest">450KB</td>
                        <td class="px-8 py-4 text-gray-400 font-medium italic">14 April 2026</td>
                        <td class="px-8 py-4 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="#" class="text-gray-300 hover:text-[#0a362d] transition-colors text-[10px] uppercase tracking-tighter">Unduh</a>
                                <button class="text-red-300 hover:text-red-600 transition-colors text-[10px] uppercase tracking-tighter">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-white border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em]">
                Menampilkan 1-6 dari 55 Item
            </p>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 text-[10px] font-black text-gray-300 uppercase tracking-widest hover:text-[#0a362d] transition-all">
                    <i class="fa-solid fa-chevron-left mr-1"></i> Kembali
                </button>

                <div class="flex items-center gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-xl bg-[#0a362d] text-white text-[10px] font-black shadow-lg shadow-[#0a362d]/20">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-xl text-gray-400 hover:bg-gray-50 text-[10px] font-bold transition-colors">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-xl text-gray-400 hover:bg-gray-50 text-[10px] font-bold transition-colors">3</button>
                </div>

                <button class="px-4 py-2 text-[10px] font-black text-[#0a362d] uppercase tracking-widest hover:translate-x-1 transition-all">
                    Lanjut <i class="fa-solid fa-chevron-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
