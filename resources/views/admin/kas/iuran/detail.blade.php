@extends('admin.layouts.admin')

@section('content')
<div class="space-y-4 animate-in fade-in duration-500">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.iuran.index') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Detail Iuran</h1>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-xl border border-gray-100">
            <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Bulan:</span>
            <span class="text-xs font-black text-[#0a362d]">APRIL 2026</span>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Daftar Pembayaran Anggota</h4>
            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">6 Baris Per Halaman</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5">Nama Pengurus</th>
                        <th class="px-6 py-5">Bulan</th>
                        <th class="px-6 py-5">Tgl Bayar</th>
                        <th class="px-6 py-5">Nominal</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    {{-- LIMIT DATA: 6 Baris --}}
                    @for ($i = 0; $i < 6; $i++)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-3.5 uppercase tracking-tighter">Dimas Riyan</td>
                        <td class="px-6 py-3.5 text-gray-400">April</td>
                        <td class="px-6 py-3.5 text-gray-400 font-medium italic">14 April 2026</td>
                        <td class="px-6 py-3.5 font-black">
                            <span class="text-[9px] text-gray-300 mr-1">RP</span>350.000
                        </td>
                        <td class="px-6 py-3.5 text-center">
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[8px] uppercase tracking-widest font-black">Lunas</span>
                        </td>
                        <td class="px-8 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="#" class="text-gray-300 hover:text-[#0a362d] transition-colors text-[10px] uppercase tracking-tighter">Edit</a>
                                <button class="text-red-300 hover:text-red-600 transition-colors text-[10px] uppercase tracking-tighter">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
