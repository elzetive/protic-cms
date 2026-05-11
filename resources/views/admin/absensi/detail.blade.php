@extends('admin.layouts.admin')

@section('content')
<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden">

    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between shrink-0">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.absensi.index') }}" class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-[#0a362d] hover:text-white transition-all shadow-sm border border-gray-100">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-lg font-black text-[#0a362d] uppercase tracking-widest leading-none">{{ $kegiatan->nama_kegiatan }}</h1>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">
                    <i class="fa-solid fa-location-dot mr-1"></i> {{ $kegiatan->lokasi }} | {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}
                </p>
            </div>
        </div>
        <div class="bg-[#0a362d] text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md">
            {{ $kegiatan->kehadiran->count() }} Orang Hadir
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-1 min-h-0">
        <div class="w-full flex flex-col">
            <div class="px-8 py-4 border-b border-gray-50 bg-gray-50/20 text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] flex justify-between shrink-0">
                <span>Nama Pengurus</span>
                <span>Waktu Presensi</span>
            </div>

            <div class="flex-1 overflow-y-auto no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-gray-50">
                        @forelse($kegiatan->kehadiran as $absen)
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4 text-left">
                                    <span class="text-[10px] font-black text-gray-300">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[11px] font-black text-[#0a362d] uppercase tracking-tight">{{ $absen->nama }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-lg text-[9px] font-black uppercase italic border border-emerald-100">
                                    {{ $absen->created_at->format('H:i') }} WIB
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-8 py-20 text-center text-gray-300 uppercase text-[10px] font-black tracking-widest italic">Belum ada data kehadiran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
