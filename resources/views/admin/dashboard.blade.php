@extends('admin.layouts.admin')

@section('content')
<div class="space-y-4 animate-in fade-in duration-500">

    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Dashboard Overview</h3>
        <div class="px-3 py-1 bg-green-50 rounded-lg">
            <p class="text-[9px] font-black text-[#0a362d] uppercase">{{ date('d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pengurus</p>
                <h4 class="text-2xl font-black text-[#0a362d]">56</h4>
            </div>
            <i class="fa-solid fa-users absolute -right-2 -bottom-2 text-5xl text-gray-50/50"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Saldo Kas</p>
                <h4 class="text-2xl font-black text-[#0a362d]"><span class="text-xs font-bold opacity-40">Rp</span> 550.000</h4>
            </div>
            <i class="fa-solid fa-wallet absolute -right-2 -bottom-2 text-5xl text-gray-50/50"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Proker Berjalan</p>
                <h4 class="text-2xl font-black text-[#0a362d]">5</h4>
            </div>
            <i class="fa-solid fa-diagram-project absolute -right-2 -bottom-2 text-5xl text-gray-50/50"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Aktivitas Terbaru</h4>
            <button class="text-[9px] font-black text-amber-600 uppercase hover:underline">Semua</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Aktivitas</th>
                        <th class="px-6 py-3 text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @for ($i = 0; $i < 5; $i++)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                        <td class="px-6 py-3 flex items-center gap-2">
                            <div class="w-6 h-6 rounded-md bg-[#0a362d] text-white flex items-center justify-center text-[8px]">D</div>
                            <div class="flex flex-col">
                                <span>Dimas Riyan</span>
                                <span class="text-[8px] text-gray-400 uppercase font-medium tracking-tighter italic">Koordinator</span>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                           Input Kas Masuk
                        </td>
                        <td class="px-6 py-3 text-right text-gray-300 font-medium">2m lalu</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
