@extends('user.layouts.app')

@section('title', 'PROGRAM KERJA - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2 text-left">
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
    <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Program</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80 text-amber-500">UKM PROTIC PNC</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-[90rem] mx-auto items-stretch">
            @forelse($data['programs'] as $index => $proker)
            <div onclick="openProkerModal('{{ $proker->id }}')" class="group relative flex flex-col h-full cursor-pointer">
                <span class="absolute -top-3 -left-1 text-4xl font-black text-white/[0.03] italic z-0 pointer-events-none group-hover:text-amber-500/10 transition-colors duration-700">
                    0{{ $index + 1 }}
                </span>

                <div class="relative z-10 flex flex-col h-full bg-white/5 backdrop-blur-sm p-4 rounded-2xl border border-white/10 shadow-xl
                            transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]
                            group-hover:border-amber-500/50 group-hover:-translate-y-4 hover:shadow-amber-500/20 hover:shadow-2xl">

                    <div class="relative overflow-hidden aspect-video rounded-xl border border-white/10 mb-5">
                        <img src="{{ asset('storage/' . $proker->gambar) }}"
                             class="w-full h-full object-cover transition-transform duration-[1.2s] ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:scale-110"
                             alt="{{ $proker->judul }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d] via-transparent to-transparent opacity-50"></div>
                    </div>

                    <div class="flex flex-col flex-grow text-center">
                        <h4 class="text-base font-bold italic text-white uppercase group-hover:text-amber-400 transition-colors duration-500 leading-snug tracking-wide px-1">
                            {{ $proker->judul }}
                        </h4>

                        <div class="mt-auto pt-6">
                            <div class="w-10 h-1 bg-white/10 mx-auto rounded-full group-hover:w-full group-hover:bg-amber-500/40 transition-all duration-700"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal-{{ $proker->id }}" class="fixed inset-0 z-[999] hidden items-center justify-center p-4 bg-[#0a362d]/90 backdrop-blur-md transition-all duration-300">
                <div class="bg-white w-full max-w-5xl max-h-[90vh] rounded-[2.5rem] md:rounded-[3.5rem] overflow-hidden shadow-2xl flex flex-col md:flex-row animate-in zoom-in duration-300">
                    <div class="w-full md:w-5/12 h-64 md:h-auto overflow-hidden">
                        <img src="{{ asset('storage/' . $proker->gambar) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-full md:w-7/12 p-8 md:p-16 overflow-y-auto text-left relative no-scrollbar">
                        <button onclick="event.stopPropagation(); closeProkerModal('{{ $proker->id }}')" class="absolute top-6 right-6 text-gray-400 hover:text-rose-500 transition-all active:scale-90">
                            <i class="fa-solid fa-circle-xmark text-3xl"></i>
                        </button>

                        <span class="text-amber-500 font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">{{ $proker->kategori ?? 'PROGRAM KERJA' }}</span>
                        <h3 class="text-3xl md:text-4xl font-black text-[#0a362d] uppercase tracking-tighter mb-8 leading-tight">{{ $proker->judul }}</h3>

                        <div class="prose prose-sm max-w-none text-gray-500 leading-relaxed font-medium text-justify">
                            {!! $proker->konten !!}
                        </div>

                        <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic text-center md:text-left">
                                PROTIC PNC &bull; Diunggah {{ $proker->created_at->format('d/m/Y') }}
                            </div>
                            <a href="{{ route('konten.detail', $proker->slug) }}" class="w-full md:w-auto text-center bg-[#0a362d] text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-xl shadow-[#0a362d]/10">
                                Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-white/50 italic text-lg uppercase tracking-widest">Belum ada program kerja yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<script>
    function openProkerModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeProkerModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    window.addEventListener('click', function(event) {
        if (event.target.id.startsWith('modal-')) {
            const id = event.target.id.split('-')[1];
            closeProkerModal(id);
        }
    });
</script>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection
