@extends('user.layouts.app')

@section('title', 'Prestasi - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-bold text-[#0a362d] mb-6 uppercase tracking-wider">Prestasi</h2>
            <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
            <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                {{ $data['desc'] }}
            </p>
        </div>
        <div class="md:w-1/2">
            <div class="relative group">
                <div class="absolute -top-4 -right-4 w-full h-full border-2 border-amber-500 rounded-xl z-0 transition-all duration-500 group-hover:top-0 group-hover:right-0"></div>
                <img src="{{ asset('img/' . $data['img_main']) }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[350px]">
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-br from-[#0a362d] via-[#082a23] to-[#041411] relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 blur-[120px] rounded-full"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-20 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Achievements</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80 text-amber-500">UKM PROTIC PNC</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-[90rem] mx-auto items-stretch">
            @forelse($data['achievements'] as $item)
            <div class="group flex flex-col h-full">
                <div class="relative flex flex-col h-full bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 p-4 shadow-2xl transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:-translate-y-4 group-hover:border-amber-500/50 group-hover:bg-white/10">

                    <div class="relative overflow-hidden rounded-2xl mb-6 shadow-inner">
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             class="w-full aspect-video object-cover transition-transform duration-[1.5s] group-hover:scale-110"
                             alt="{{ $item->judul }}">

                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    <div class="text-center flex-grow flex flex-col items-center">
                        <div class="w-8 h-[2px] bg-amber-500 mb-4 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                        <h5 class="text-white font-bold text-sm tracking-wider leading-snug px-2 group-hover:text-amber-400 transition-colors duration-300 uppercase">
                            {{ $item->judul }}
                        </h5>

                        <div class="mt-auto pt-6">
                            <span class="inline-block px-4 py-1.5 rounded-full border border-amber-500/30 bg-amber-500/10 text-amber-500 text-[10px] font-bold tracking-[0.2em] transition-all duration-500 group-hover:bg-amber-500 group-hover:text-[#0a362d] uppercase">
                                {{ $item->sub_judul }}
                            </span>
                        </div>
                    </div>

                    <div class="absolute -inset-px bg-gradient-to-b from-amber-500/10 to-transparent rounded-[1.5rem] opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-white/50 italic text-lg opacity-80 uppercase">Belum ada prestasi yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
