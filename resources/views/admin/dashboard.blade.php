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
                <div class="flex items-center justify-between mb-1">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Pengurus</p>
                    <span class="text-[8px] bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full font-black uppercase">
                        Periode {{ $periodeTerbaru }}/{{ $periodeTerbaru + 1 }}
                    </span>
                </div>
                <h4 class="text-2xl font-black text-[#0a362d]">{{ $countPengurus }}</h4>
            </div>
            <i class="fa-solid fa-users absolute -right-2 -bottom-2 text-5xl text-gray-50/50 transition-transform group-hover:scale-110"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Saldo Kas</p>
                <h4 class="text-2xl font-black text-[#0a362d]">
                    <span class="text-xs font-bold opacity-40">Rp</span> {{ number_format($saldoKas, 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid fa-wallet absolute -right-2 -bottom-2 text-5xl text-gray-50/50 transition-transform group-hover:scale-110"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Proker Terbit</p>
                <h4 class="text-2xl font-black text-[#0a362d]">{{ $countProker }}</h4>
            </div>
            <i class="fa-solid fa-diagram-project absolute -right-2 -bottom-2 text-5xl text-gray-50/50 transition-transform group-hover:scale-110"></i>
        </div>

    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Transaksi Kas Terbaru</h4>
            <a href="{{ route('admin.kas.index') }}" class="text-[9px] font-black text-amber-600 uppercase hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Nominal</th>
                        <th class="px-6 py-3 text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @forelse ($latestActivity as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-md {{ $item->tipe == 'Masuk' ? 'bg-emerald-500' : 'bg-rose-500' }} text-white flex items-center justify-center text-[8px]">
                                    <i class="fa-solid {{ $item->tipe == 'Masuk' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="uppercase">{{ $item->kategori }}</span>
                                    <span class="text-[8px] text-gray-400 uppercase font-medium tracking-tighter italic">{{ $item->keterangan }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3 {{ $item->tipe == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $item->tipe == 'Masuk' ? '+' : '-' }} {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-right text-gray-300 font-medium">
                            {{ $item->tanggal }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-300 uppercase text-[9px] tracking-widest italic">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
