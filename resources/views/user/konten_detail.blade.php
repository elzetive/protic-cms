@extends('user.layouts.app')

@section('title', strtoupper($konten->kategori) . ' - ' . $konten->judul)

@section('content')
<article class="min-h-screen bg-white pb-32 animate-in fade-in duration-700">
    <header class="relative h-[45vh] md:h-[55vh] flex items-center overflow-hidden bg-[#0a362d]">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/header.JPG') }}" class="w-full h-full object-cover opacity-20 scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d] via-transparent to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 lg:px-20 relative z-10 text-left">
            <div class="inline-flex items-center gap-3 bg-amber-500 text-[#0a362d] px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6 shadow-xl animate-in slide-in-from-bottom duration-700">
                <i class="fa-solid {{ $konten->kategori == 'Proker' ? 'fa-calendar-check' : 'fa-trophy' }}"></i>
                {{ $konten->kategori == 'Proker' ? 'Program Kerja' : 'Prestasi UKM' }}
            </div>

            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-none max-w-4xl mb-8">
                {{ $konten->judul }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-white/60 text-[10px] font-bold uppercase tracking-widest border-t border-white/10 pt-8">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calendar-day text-amber-500 text-sm"></i>
                    <span>Diterbitkan: {{ $konten->created_at->format('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-pen text-amber-500 text-sm"></i>
                    <span>Admin PROTIC</span>
                </div>
            </div>
        </div>
    </header>

    <section class="container mx-auto px-6 lg:px-20 -mt-16 relative z-20 text-left">
        <div class="flex flex-col lg:flex-row gap-16">

            <div class="w-full lg:w-8/12 flex flex-col gap-6">
                <div class="flex">
                    <a href="{{ $konten->kategori == 'Proker' ? route('proker') : route('prestasi') }}"
                       class="bg-white hover:bg-amber-500 text-[#0a362d] hover:text-white px-6 py-3 rounded-2xl shadow-xl transition-all duration-300 flex items-center gap-3 group border border-gray-100">
                        <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">
                            Kembali
                        </span>
                    </a>
                </div>

                <div class="bg-white p-8 md:p-16 rounded-[3rem] shadow-[0_30px_100px_rgba(10,54,45,0.08)] border border-gray-50">
                    @if($konten->gambar)
                    <div class="mb-12 rounded-[2rem] overflow-hidden shadow-2xl ring-1 ring-black/5">
                        <img src="{{ asset('storage/' . $konten->gambar) }}" class="w-full h-full object-cover aspect-video" alt="{{ $konten->judul }}">
                    </div>
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-600 font-medium text-justify whitespace-pre-line
                                prose-headings:text-[#0a362d] prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter
                                prose-p:leading-relaxed prose-strong:text-[#0a362d] prose-strong:font-black">

                        @if($konten->isi)
                            {!! $konten->isi !!}
                        @else
                            <p class="italic text-gray-400">Deskripsi {{ strtolower($konten->kategori) }} belum tersedia.</p>
                        @endif
                    </div>

                    <div class="mt-20 pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                        <h5 class="text-[10px] font-black text-[#0a362d] uppercase tracking-widest italic">Bagikan Informasi:</h5>
                        <div class="flex gap-3">
                            <a href="https://wa.me/?text={{ urlencode($konten->judul . ' - ' . url()->current()) }}" target="_blank" class="w-12 h-12 rounded-2xl bg-[#0a362d]/5 text-[#0a362d] flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-2xl bg-[#0a362d]/5 text-[#0a362d] flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="w-full lg:w-4/12 space-y-8 pt-0 lg:pt-20">
                <div class="bg-[#0a362d] p-8 rounded-[2.5rem] text-white relative overflow-hidden group">
                    <i class="fa-solid fa-code absolute -right-4 -bottom-4 text-7xl opacity-10 group-hover:scale-125 transition-transform duration-700"></i>
                    <h4 class="text-sm font-black uppercase tracking-widest mb-4">UKM PROTIC PNC</h4>
                    <p class="text-[11px] text-white/70 leading-relaxed font-medium mb-6 italic">Improve Skill to Innovate.</p>
                    <a href="{{ route('profil') }}" class="inline-flex items-center gap-3 text-amber-500 font-black text-[10px] uppercase tracking-widest group/link">
                        Kenali Kami <i class="fa-solid fa-arrow-right transition-transform group-hover/link:translate-x-2"></i>
                    </a>
                </div>

                <div class="bg-gray-50 p-8 rounded-[2.5rem] border border-gray-100">
                    <h4 class="text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-8 flex items-center gap-3 leading-none">
                        <span class="w-8 h-[2px] bg-amber-500"></span>
                        {{ $konten->kategori == 'Proker' ? 'Kegiatan Proker Lain' : 'Prestasi Lainnya' }}
                    </h4>

                    <div class="space-y-6 text-left">
                        @foreach($kontenLainnya as $lain)
                        <a href="{{ route('konten.detail', $lain->slug) }}" class="flex gap-4 group">
                            <div class="w-16 h-16 shrink-0 rounded-2xl overflow-hidden border border-gray-200 bg-white">
                                <img src="{{ asset('storage/' . $lain->gambar) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110 duration-500">
                            </div>
                            <div class="flex flex-col justify-center">
                                <h5 class="text-[10px] font-black text-[#0a362d] uppercase leading-tight line-clamp-2 group-hover:text-amber-600 transition-colors">
                                    {{ $lain->judul }}
                                </h5>
                                <span class="text-[8px] text-gray-400 font-bold mt-1 uppercase tracking-widest">{{ $lain->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>
</article>

<style>
    .whitespace-pre-line { white-space: pre-line; }
    .prose strong { color: #0a362d !important; font-weight: 900 !important; }
    .prose p { margin-bottom: 1.5rem !important; }
</style>
@endsection
