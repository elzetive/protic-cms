@extends('user.layouts.app')

@section('title', $konten->judul)

@section('content')
<article class="py-24 bg-white animate-in fade-in duration-700">
    <div class="container mx-auto px-6 max-w-4xl">

        {{-- KATEGORI & TANGGAL --}}
        <div class="flex items-center gap-4 mb-8">
            <span class="bg-amber-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em]">
                {{ $konten->kategori }}
            </span>
            <span class="text-gray-300 text-xs font-bold uppercase tracking-widest italic">
                / {{ $konten->created_at->format('d F Y') }}
            </span>
        </div>

        {{-- JUDUL UTAMA --}}
        <h1 class="text-4xl md:text-5xl font-black text-[#0a362d] uppercase leading-tight mb-12 tracking-tighter">
            {{ $konten->judul }}
        </h1>

        {{-- GAMBAR UTAMA (PROPORSI RAPI) --}}
        @if($konten->gambar)
        <div class="relative max-w-2xl mx-auto mb-16">
            <div class="aspect-video rounded-[2.5rem] overflow-hidden shadow-2xl border-[8px] border-gray-50">
                <img src="{{ asset('storage/' . $konten->gambar) }}"
                     class="w-full h-full object-cover transform hover:scale-105 transition duration-1000">
            </div>
            {{-- Aksen Dekoratif --}}
            <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-amber-500/10 rounded-full blur-3xl -z-10"></div>
        </div>
        @endif

        {{-- ISI BERITA --}}
        <div class="prose prose-lg max-w-none">
            {{-- Text di-justify biar rapi, italic sesuai desain awal kamu --}}
            <div class="text-gray-600 leading-relaxed text-lg text-justify italic font-medium space-y-6">
                {!! nl2br(e($konten->isi)) !!}
            </div>
        </div>

        {{-- FOOTER ARTIKEL --}}
        <div class="mt-20 pt-10 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#0a362d] rounded-2xl flex items-center justify-center text-amber-500 shadow-lg">
                    <i class="fa-solid fa-shield-cat text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Penulis Resmi</p>
                    <p class="text-xs font-black text-[#0a362d] uppercase">HUMAS UKM PROTIC</p>
                </div>
            </div>

            <a href="{{ route('beranda') }}" class="group flex items-center gap-3 bg-gray-50 px-6 py-3 rounded-2xl text-[10px] font-black text-gray-400 uppercase tracking-widest hover:bg-[#0a362d] hover:text-white transition-all">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-2 transition-transform"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</article>
@endsection
