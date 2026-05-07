@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 animate-in fade-in duration-500">
    <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.iuran.index') }}" class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Riwayat Iuran</h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2 italic">{{ $nama }}</p>
            </div>
        </div>
        <div class="px-6 py-2 bg-[#0a362d] text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-[#0a362d]/20">
            Total Bayar: Rp {{ number_format($riwayat->sum('nominal'), 0, ',', '.') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1 bg-white p-8 rounded-[3rem] border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4 border-4 border-gray-100 overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($nama) }}&background=0a362d&color=fff" class="w-full h-full object-cover">
            </div>
            <h4 class="font-black text-[#0a362d] uppercase text-sm leading-tight mb-1">{{ $nama }}</h4>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest italic">pengurus Aktif PROTIC</p>
        </div>

        <div class="md:col-span-2 bg-white rounded-[3rem] border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30">
                <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Log Pembayaran</h4>
            </div>
            <div class="flex-1 overflow-y-auto max-h-[400px] no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">
                            <th class="px-8 py-3">Bulan</th>
                            <th class="px-8 py-3">Periode</th>
                            <th class="px-8 py-3 text-right">Nominal</th>
                            <th class="px-8 py-3 text-center text-gray-300"><i class="fa-solid fa-ellipsis"></i></th>
                        </tr>
                    </thead>
                    <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50 uppercase">
                        @forelse ($riwayat as $item)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="px-8 py-4 tracking-tighter">{{ $item->kategori }}</td>
                            <td class="px-8 py-4 text-gray-400 font-medium italic">{{ $item->periode }}</td>
                            <td class="px-8 py-4 text-right font-black text-emerald-600">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-center">
                                <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data iuran ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-200 hover:text-rose-500 transition-all"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-gray-300 italic uppercase text-[10px] tracking-widest">Belum ada riwayat pembayaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
