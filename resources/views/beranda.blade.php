@extends('layouts.app')

@section('title', 'Beranda - UKM PROTIC PNC')

@section('content')
<header class="relative min-h-screen flex items-center justify-center text-center">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/header.JPG') }}" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#f8faf9]"></div>
    </div>

    <div class="relative z-10 px-4">
        <span class="border border-[#0a362d] text-[#0a362d] px-6 py-2 rounded-full text-[10px] font-bold mb-8 inline-block tracking-[0.3em]">
            SELAMAT DATANG DI UKM PROTIC PNC 25/26
        </span>

        <h2 class="text-4xl md:text-6xl font-black text-[#0a362d] tracking-[0.15em] uppercase mb-6 leading-tight">
            Programming Technology <br> Informatics Club
        </h2>

        <div class="flex justify-center mb-6">
            <div class="h-1.5 w-24 bg-amber-500 rounded-full"></div>
        </div>

        <p class="font-bold text-gray-400 tracking-[0.5em] text-xs uppercase">
            #IMPROVESKILLTOINNOVATE
        </p>
    </div>
</header>

<section class="py-24 bg-white">
    <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-center gap-20">
        <div class="w-full md:w-1/3 max-w-sm relative group">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl ring-8 ring-[#0a362d]/5">
                <img src="{{ asset('img/thumbnail-video.jpg') }}" class="w-full h-auto">
                <div class="absolute inset-0 flex items-center justify-center bg-[#0a362d]/20 group-hover:bg-[#0a362d]/10 transition">
                    <button class="bg-amber-500 text-white p-5 rounded-full hover:scale-110 shadow-2xl transition">
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2">
            <p class="text-emerald-600 font-bold uppercase tracking-widest text-xs mb-4">Who We Are</p>
            <h3 class="text-5xl font-bold text-[#0a362d] mb-8">Video Profile</h3>
            <p class="text-gray-500 leading-relaxed text-lg font-light">
                Unit Kegiatan Mahasiswa <span class="font-bold text-[#0a362d]">Programming Technology Informatics Club</span>
                mewadahi minat dan bakat mahasiswa Politeknik Negeri Cilacap (PNC) dalam bidang
                pemrograman dan teknologi informasi.
            </p>
        </div>
    </div>
</section>
@endsection
