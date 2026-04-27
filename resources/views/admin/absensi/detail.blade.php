@extends('admin.layouts.admin')

@section('content')
{{-- space-y-4 biar header & tabel nempel pas --}}
<div class="space-y-4 animate-in fade-in duration-500">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.absensi.index') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div class="flex flex-col">
                <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Rapat Rutinan</h1>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">14 April 2026</span>
            </div>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl border border-gray-100 shadow-sm">
            <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Kehadiran:</span>
            <span class="text-xs font-black text-[#0a362d]">30/55</span>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-4">Nama Pengurus</th>
                        <th class="px-8 py-4">Divisi</th>
                        <th class="px-8 py-4 text-center">Jam Absen</th>
                        <th class="px-8 py-4 text-center">Status</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    {{-- 9 BARIS: Muat banyak, tetap no-scroll karena teks ramping --}}
                    @for ($i = 0; $i < 9; $i++)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-3 uppercase tracking-tighter">Dimas Riyan</td>
                        <td class="px-8 py-3 text-gray-400 uppercase text-[9px] tracking-widest">Humas</td>
                        <td class="px-8 py-3 text-center text-gray-400 font-medium italic">16.15 WIB</td>
                        <td class="px-8 py-3 text-center">
                            <span class="bg-green-50 text-green-600 px-3 py-0.5 rounded-full text-[8px] uppercase tracking-widest font-black">Hadir</span>
                        </td>
                        <td class="px-8 py-3 text-center">
                            <div class="flex items-center justify-center gap-4 opacity-30 group-hover:opacity-100 transition-opacity">
                                <button class="text-[#0a362d] text-[9px] uppercase tracking-tighter">Edit</button>
                                <button class="text-red-400 text-[9px] uppercase tracking-tighter">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        {{-- Footer Tipis --}}
        <div class="px-8 py-3 bg-gray-50/30 border-t border-gray-50 flex justify-between items-center">
            <p class="text-[9px] text-gray-300 font-black uppercase tracking-[0.2em]">Data Absensi Terkunci</p>
            <div class="flex items-center gap-1">
                <button class="w-6 h-6 rounded-lg bg-[#0a362d] text-white text-[9px] font-black">1</button>
                <button class="w-6 h-6 rounded-lg text-gray-400 text-[9px] font-bold">2</button>
            </div>
        </div>
    </div>
</div>
@endsection
