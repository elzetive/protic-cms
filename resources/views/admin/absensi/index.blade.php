@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Absensi Kegiatan</h1>
        <a href="{{ route('admin.absensi.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95">
            <i class="fa-solid fa-plus text-[10px]"></i> TAMBAH KEGIATAN
        </a>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5">Nama Kegiatan</th>
                        <th class="px-8 py-5">Tanggal</th>
                        <th class="px-8 py-5 text-center">Kehadiran</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    {{-- LIMIT DATA: 6 Baris agar no-scroll --}}
                    @for ($i = 0; $i < 6; $i++)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-4 uppercase tracking-tighter">
                            Rapat Rutinan PROTIC
                        </td>
                        <td class="px-8 py-4 text-gray-400 font-medium italic">
                            10 April 2026
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex flex-col gap-1.5 w-32 mx-auto">
                                <div class="flex justify-between text-[9px] uppercase tracking-widest">
                                    <span class="text-gray-400 italic">30/55 Hadir</span>
                                </div>
                                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-[#0a362d] h-full rounded-full" style="width: 60%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-center">
                            @if($i % 2 == 0)
                                <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[8px] uppercase tracking-widest font-black">Selesai</span>
                            @else
                                <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full text-[8px] uppercase tracking-widest font-black">Berlangsung</span>
                            @endif
                        </td>
                        <td class="px-8 py-4 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.absensi.detail') }}" class="text-gray-300 hover:text-[#0a362d] transition-colors text-[10px] uppercase tracking-tighter">Lihat</a>
                                <a href="{{ route('admin.absensi.qrcode') }}" class="text-amber-600 hover:text-amber-700 transition-colors text-[10px] uppercase tracking-tighter font-black">Bagikan</a>
                                <button class="text-red-300 hover:text-red-600 transition-colors text-[10px] uppercase tracking-tighter">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-white border-t border-gray-50 flex items-center justify-between gap-4">
            <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em]">
                Menampilkan 1-6 dari 15 Kegiatan
            </p>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 text-[10px] font-black text-gray-300 uppercase tracking-widest hover:text-[#0a362d] transition-all">
                    <i class="fa-solid fa-chevron-left mr-1"></i> Kembali
                </button>

                <div class="flex items-center gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-xl bg-[#0a362d] text-white text-[10px] font-black shadow-lg shadow-[#0a362d]/20">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-xl text-gray-400 hover:bg-gray-50 text-[10px] font-bold transition-colors">2</button>
                </div>

                <button class="px-4 py-2 text-[10px] font-black text-[#0a362d] uppercase tracking-widest hover:translate-x-1 transition-all">
                    Lanjut <i class="fa-solid fa-chevron-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
