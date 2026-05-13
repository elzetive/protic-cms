@extends('user.layouts.app')

@section('title', 'PROGRAM KERJA - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16 text-left">
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

<section class="py-24 bg-gradient-to-br from-[#0a362d] via-[#082a23] to-[#041411] relative overflow-hidden text-center">
    <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="mb-16 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Program</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80 text-amber-500">UKM PROTIC PNC</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-[90rem] mx-auto items-stretch">
            @forelse($data['programs'] as $index => $proker)
            <div onclick="openPreviewModal('{{ $proker->id }}')" class="group relative flex flex-col h-full cursor-pointer">
                <span class="absolute -top-3 -left-1 text-4xl font-black text-white/[0.03] italic z-0 pointer-events-none group-hover:text-amber-500/10 transition-colors duration-700">
                    0{{ $index + 1 }}
                </span>

                <div class="relative z-10 flex flex-col h-full bg-white/5 backdrop-blur-sm p-4 rounded-2xl border border-white/10 shadow-xl
                            transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)]
                            group-hover:border-amber-500/50 group-hover:-translate-y-4 hover:shadow-amber-500/20 hover:shadow-2xl text-left">

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

            <div id="modal-{{ $proker->id }}" class="fixed inset-0 z-[999] hidden items-center justify-center p-6 bg-[#0a362d]/90 backdrop-blur-sm transition-all duration-300 text-left">
                <div class="bg-white w-full max-w-4xl rounded-[3rem] overflow-hidden shadow-2xl flex flex-col md:flex-row relative animate-in zoom-in duration-300">
                    <button onclick="event.stopPropagation(); closePreviewModal('{{ $proker->id }}')" class="absolute top-6 right-6 z-50 bg-rose-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:scale-110 active:scale-90 transition-all">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="w-full md:w-1/2 h-64 md:h-auto overflow-hidden">
                        <img src="{{ asset('storage/' . $proker->gambar) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center">
                        <span class="text-amber-500 font-black uppercase tracking-[0.4em] text-[9px] mb-4 block">PROGRAM KERJA</span>
                        <h3 class="text-3xl md:text-4xl font-black text-[#0a362d] uppercase tracking-tighter mb-8 leading-tight border-b border-gray-100 pb-8">{{ $proker->judul }}</h3>
                        <div class="flex items-center justify-between gap-4">
                            <div class="text-[9px] font-black text-gray-400 uppercase tracking-widest italic">PROTIC PNC &bull; {{ $proker->created_at->format('d/m/Y') }}</div>
                            <a href="{{ route('konten.detail', $proker->slug) }}" class="bg-[#0a362d] text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-xl shadow-[#0a362d]/10">
                                Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20"><p class="text-white/50 italic uppercase">Belum ada program kerja.</p></div>
            @endforelse
        </div>
    </div>
</section>

<script>
    function openPreviewModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closePreviewModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    window.addEventListener('click', (e) => { if(e.target.id.startsWith('modal-')) closePreviewModal(e.target.id.split('-')[1]); });
</script>
@endsection
