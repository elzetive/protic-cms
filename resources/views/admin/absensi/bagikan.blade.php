@extends('admin.layouts.admin')

@section('content')
{{-- Container dibuat setinggi layar (Full Centered) tanpa scroll --}}
<div class="flex flex-col items-center justify-center h-[calc(100vh-150px)] animate-in zoom-in duration-500">

    <div class="bg-white p-10 rounded-[3rem] border border-gray-100 shadow-2xl shadow-[#0a362d]/5 flex flex-col items-center text-center max-w-sm w-full relative overflow-hidden">

        {{-- Header Dekoratif --}}
        <div class="absolute top-0 left-0 w-full h-2 bg-[#0a362d]"></div>
        <div class="absolute top-0 right-0 w-16 h-16 bg-amber-400/10 rounded-full -mr-8 -mt-8"></div>

        <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-[0.2em] mb-4">Live Presensi</span>

        <h1 class="text-lg font-black text-[#0a362d] uppercase tracking-widest leading-tight">
            Rapat Koordinasi<br>Makrab 2026
        </h1>
        <p class="text-[10px] font-bold text-gray-300 mt-2 tracking-widest uppercase italic border-b border-gray-50 pb-4 w-full">14 April 2026</p>

        {{-- Area QR Code dengan Warna Hijau PROTIC --}}
        <div class="my-8 relative group">
            {{-- Efek Glow di belakang QR --}}
            <div class="absolute -inset-4 bg-gradient-to-tr from-amber-400 to-[#0a362d] rounded-[2.5rem] opacity-10 blur-xl group-hover:opacity-20 transition-opacity"></div>

            <div class="relative p-5 bg-white border-[6px] border-[#0a362d] rounded-[2.5rem] shadow-xl">
                {{-- Parameter color=0a362d bikin QR nya jadi Hijau, bukan Hitam --}}
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=PROTIC-ABSENSI-2026&color=0a362d"
                     class="w-44 h-44 object-contain"
                     alt="QR Absensi">
            </div>
        </div>

        {{-- Footer Kartu --}}
        <div class="space-y-1">
            <p class="text-[11px] text-[#0a362d] font-black uppercase tracking-tighter">Scan untuk presensi</p>
            <p class="text-[9px] text-gray-400 font-medium leading-relaxed max-w-[200px] mx-auto uppercase tracking-tighter">
                Arahkan kamera Anda tepat ke area QR Code di atas
            </p>
        </div>
    </div>

    {{-- Tombol Back di bawah Card --}}
    <a href="{{ route('admin.absensi.index') }}" class="mt-8 flex items-center gap-2 text-gray-400 hover:text-[#0a362d] font-black text-[10px] uppercase tracking-[0.2em] transition-all group">
        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali ke Dashboard
    </a>
</div>
@endsection
