@extends('user.layouts.app')

@section('title', 'Beranda - UKM PROTIC PNC')

@section('content')
<header class="relative min-h-[85vh] flex items-center justify-center text-center overflow-hidden bg-[#f8faf9]">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/header.JPG') }}" class="w-full h-full object-cover opacity-10 scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-transparent to-[#f8faf9]"></div>
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] select-none pointer-events-none">
            <h1 class="text-[20vw] font-black leading-none uppercase italic">PROTIC</h1>
        </div>
    </div>

    <div class="relative z-20 px-4 max-w-5xl mx-auto w-full">
        <div class="inline-flex items-center gap-3 border border-[#0a362d]/10 bg-white/50 backdrop-blur-sm px-6 py-2 rounded-full mb-10 transition-all duration-300 hover:-translate-y-1 hover:border-amber-500/50 hover:shadow-lg hover:shadow-amber-500/10 group cursor-default">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
            </span>
            <span class="text-[#0a362d] text-[10px] font-bold tracking-[0.3em] uppercase transition-colors duration-300 group-hover:text-amber-600">
                UKM PROTIC PNC {{ substr($periodeTerbaru, -2) }}/{{ substr($periodeTerbaru + 1, -2) }}
            </span>
        </div>

        <h2 class="text-4xl md:text-6xl font-black text-[#0a362d] tracking-tighter uppercase mb-8 leading-[1.1]">
            <span class="block">Programming Technology</span>
            <span class="block text-transparent italic" style="-webkit-text-stroke: 1px #0a362d;">
                Informatics Club
            </span>
        </h2>

        <div class="flex justify-center mb-10">
            <div class="h-1.5 w-20 bg-amber-500 rounded-full shadow-[0_0_15px_rgba(245,158,11,0.3)]"></div>
        </div>

        <p class="font-bold text-[#0a362d]/50 tracking-[0.5em] text-[10px] md:text-xs uppercase italic">
            #IMPROVESKILLTOINNOVATE
        </p>
    </div>
</header>

<section class="py-32 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-green-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50"></div>
    <div class="container mx-auto px-6 lg:px-20 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-center gap-20">
            <div class="w-full lg:w-1/2 max-w-lg relative group">
                <div class="absolute -top-5 -left-5 w-32 h-32 border-t-4 border-l-4 border-amber-500 rounded-tl-3xl z-0 transition-all duration-500 group-hover:-top-2 group-hover:-left-2"></div>
                <div class="absolute -bottom-5 -right-5 w-32 h-32 border-b-4 border-r-4 border-amber-500 rounded-br-3xl z-0 transition-all duration-500 group-hover:-bottom-2 group-hover:-right-2"></div>
                <div class="relative rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(10,54,45,0.15)] ring-1 ring-black/5 z-10">
                    <img src="{{ asset('img/thumbnail-video.jpg') }}" class="w-full h-full object-cover aspect-video transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 flex items-center justify-center bg-[#0a362d]/30 group-hover:bg-[#0a362d]/20 transition-all duration-500">
                        <button class="relative group/btn">
                            <div class="absolute inset-0 bg-amber-500 rounded-full animate-ping opacity-20"></div>
                            <div class="relative bg-amber-500 text-white w-20 h-20 rounded-full flex items-center justify-center shadow-2xl transition-transform group-hover/btn:scale-110">
                                <svg class="w-8 h-8 ml-1 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 text-left">
                <div class="inline-flex items-center gap-4 mb-6">
                    <div class="h-[2px] w-12 bg-amber-500"></div>
                    <span class="text-emerald-600 font-black uppercase tracking-[0.3em] text-[10px]">Who We Are</span>
                </div>
                <h3 class="text-5xl lg:text-6xl font-black text-[#0a362d] mb-8 leading-tight uppercase">Video <br><span class="text-amber-500 italic">Profile</span></h3>
                <p class="text-gray-500 leading-relaxed text-lg font-medium italic text-justify">
                    Unit Kegiatan Mahasiswa <span class="font-bold text-[#0a362d] not-italic border-b-2 border-amber-500/30">Programming Technology Informatics Club</span>
                    mewadahi minat dan bakat mahasiswa Politeknik Negeri Cilacap dalam bidang
                    pemrograman dan eksplorasi teknologi masa depan.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-32 bg-[#f8faf9] relative">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="text-left">
                <div class="inline-flex items-center gap-4 mb-4">
                    <div class="h-[2px] w-12 bg-amber-500"></div>
                    <span class="text-emerald-600 font-black uppercase tracking-[0.3em] text-[10px]">OUR ACTIVITIES</span>
                </div>
                <h3 class="text-5xl font-black text-[#0a362d] uppercase tracking-tighter">Program kerja</h3>
            </div>
            <a href="{{ route('proker') }}" class="group flex items-center gap-4 bg-white border border-gray-100 px-8 py-4 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <span class="text-[11px] font-black uppercase tracking-widest text-[#0a362d]">Lihat Semua Kegiatan</span>
                <i class="fa-solid fa-arrow-right text-amber-500 transition-transform group-hover:translate-x-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            @forelse($proker as $item)
            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100 flex flex-col h-full">
                <div class="relative h-64 overflow-hidden shrink-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <i class="fa-solid fa-image text-gray-300 text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="bg-[#0a362d] text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                            {{ $item->kategori }}
                        </span>
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                        <i class="fa-solid fa-calendar-days text-amber-500"></i>
                        {{ $item->created_at->format('d M, Y') }}
                    </div>
                    <h4 class="text-xl font-black text-[#0a362d] uppercase leading-tight mb-6 line-clamp-2 flex-grow">
                        {{ $item->judul }}
                    </h4>
                    <a href="{{ route('konten.detail', $item->slug) }}" class="inline-flex items-center gap-3 text-amber-600 font-black text-[11px] uppercase tracking-[0.2em] group/link">
                        Detail Kegiatan
                        <div class="h-[2px] w-6 bg-amber-500 transition-all duration-300 group-hover/link:w-12"></div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-20 bg-white rounded-[2.5rem] border-2 border-dashed border-gray-100">
                <i class="fa-solid fa-calendar-xmark text-gray-200 text-6xl mb-6"></i>
                <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada program kerja yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-32 bg-white">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="text-center max-w-2xl mx-auto mb-20">
            <div class="inline-flex items-center gap-4 mb-4">
                <div class="h-[2px] w-12 bg-amber-500"></div>
                <span class="text-emerald-600 font-black uppercase tracking-[0.3em] text-[10px]">Our Achievements</span>
                <div class="h-[2px] w-12 bg-amber-500"></div>
            </div>
            <h3 class="text-5xl font-black text-[#0a362d] uppercase tracking-tighter mb-6">Prestasi Kami</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($prestasi as $item)
            <div class="relative group h-80 rounded-[2rem] overflow-hidden shadow-xl">
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-125">
                @else
                    <div class="w-full h-full bg-gray-200"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d] via-[#0a362d]/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <p class="text-amber-500 text-[9px] font-black uppercase tracking-widest mb-2">Prestasi UKM</p>
                    <h4 class="text-white text-sm font-black uppercase leading-snug line-clamp-2">
                        {{ $item->judul }}
                    </h4>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-10">
                <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Data prestasi belum tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
