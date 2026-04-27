@extends('user.layouts.app')

@section('title', 'Program Kerja - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-bold text-[#0a362d] mb-6 uppercase tracking-wider">Program Kerja</h2>
            <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
            <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                {{ $data['desc'] }}
            </p>
        </div>
        <div class="md:w-1/2">
            <div class="relative group">
                <div class="absolute -top-4 -right-4 w-full h-full border-2 border-amber-500 rounded-xl z-0 transition-all duration-300 group-hover:top-0 group-hover:right-0"></div>
                <img src="{{ asset('img/' . $data['img_main']) }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[350px]">
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-br from-[#0a362d] via-[#082a23] to-[#041411] relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
<div class="text-center mb-16 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Program</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80 text-amber-500">UKM PROTIC PNC</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto items-stretch">
            @foreach($data['programs'] as $index => $proker)
            <div class="group relative flex flex-col h-full">

                <span class="absolute -top-4 -left-2 text-6xl font-black text-white/[0.03] italic z-0 pointer-events-none group-hover:text-amber-500/10 transition-colors duration-700">
                    0{{ $index + 1 }}
                </span>

                <div class="relative z-10 flex flex-col h-full bg-white/5 backdrop-blur-sm p-5 rounded-2xl border border-white/10 shadow-xl
                            transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]
                            group-hover:border-amber-500/50 group-hover:-translate-y-4 hover:shadow-amber-500/20 hover:shadow-2xl">

                    <div class="relative overflow-hidden aspect-video rounded-xl border border-white/10 mb-6">
                        <img src="{{ asset('img/proker/' . $proker['img']) }}"
                             class="w-full h-full object-cover transition-transform duration-[1.2s] ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:scale-110"
                             alt="{{ $proker['name'] }}">

                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d] via-transparent to-transparent opacity-50"></div>
                    </div>

                    <div class="flex flex-col flex-grow text-center">
                        <h4 class="text-xl font-bold italic text-white group-hover:text-amber-400 transition-colors duration-500 leading-snug tracking-wide">
                            {{ $proker['name'] }}
                        </h4>

                        <div class="mt-auto pt-8">
                            <div class="w-12 h-1 bg-white/10 mx-auto rounded-full group-hover:w-full group-hover:bg-amber-500/40 transition-all duration-700"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
