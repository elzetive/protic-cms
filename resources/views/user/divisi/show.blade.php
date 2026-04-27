@extends('user.layouts.app')

@section('title', $data['title'] . ' - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-bold text-[#0a362d] mb-6 uppercase tracking-wider">{{ $data['title'] }}</h2>
            <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
            <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                {{ $data['desc'] }}
            </p>
        </div>
        <div class="md:w-1/2">
            <div class="relative group">
                <div class="absolute -top-4 -right-4 w-full h-full border-2 border-amber-500 rounded-xl z-0 transition-all duration-300 group-hover:top-0 group-hover:right-0"></div>
                <img src="{{ asset('img/' . $data['img_group']) }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[350px]">
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-gradient-to-br from-[#0a362d] via-[#082a23] to-[#041411] relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Team</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80 text-amber-500">{{ $data['title'] }}</p>
        </div>

        <div class="relative max-w-6xl mx-auto group/slider">
            <div id="sliderViewport" class="overflow-hidden max-w-5xl mx-auto px-2">
                <div id="memberSlider" class="flex transition-transform duration-700 ease-in-out">

                    @forelse($data['members'] as $member)
                    <div class="member-item w-full sm:w-1/2 md:w-1/4 flex-shrink-0 px-3 py-4">

                        <div class="group relative bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 p-3 shadow-2xl transition-all duration-500 hover:bg-white/10 hover:-translate-y-4 hover:border-amber-500/50">

                            <div class="relative overflow-hidden rounded-2xl mb-5 shadow-inner">
                                <img src="{{ asset('img/member/' . $member['img']) }}"
                                     class="w-full aspect-[3/4] object-cover transition-transform duration-700 group-hover:scale-110"
                                     alt="{{ $member['name'] }}">

                                <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            <div class="text-center pb-4">
                                <div class="w-8 h-[2px] bg-amber-500 mx-auto mb-3 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                                <h4 class="font-black text-white text-xs uppercase tracking-wider leading-tight px-2 group-hover:text-amber-400 transition-colors">
                                    {{ $member['name'] }}
                                </h4>

                                <div class="mt-3 inline-block px-4 py-1 rounded-full border border-white/10 bg-white/5 text-amber-500 text-[9px] font-bold uppercase tracking-[0.2em] group-hover:bg-amber-500 group-hover:text-[#0a362d] transition-all duration-500">
                                    {{ $member['role'] }}
                                </div>
                            </div>

                            <div class="absolute -inset-px bg-gradient-to-b from-amber-500/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
                        </div>
                    </div>
                    @empty
                    <div class="w-full text-center text-white py-10 opacity-60 italic">Belum ada data anggota.</div>
                    @endforelse

                </div>
            </div>

            @if(count($data['members']) > 4)
            <button onclick="slidePrev()" class="absolute -left-6 lg:-left-12 top-1/2 -translate-y-1/2 bg-white text-[#0a362d] w-12 h-12 rounded-full shadow-xl transition-all opacity-0 group-hover/slider:opacity-100 hidden md:flex items-center justify-center hover:bg-amber-500 hover:text-white z-30">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button onclick="slideNext()" class="absolute -right-6 lg:-right-12 top-1/2 -translate-y-1/2 bg-white text-[#0a362d] w-12 h-12 rounded-full shadow-xl transition-all opacity-0 group-hover/slider:opacity-100 hidden md:flex items-center justify-center hover:bg-amber-500 hover:text-white z-30">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            @endif
        </div>
    </div>
</section>

<script>
    let currentPos = 0;
    const slider = document.getElementById('memberSlider');
    const items = document.querySelectorAll('.member-item');
    const totalItems = items.length;

    function slideNext() {
        if (currentPos < totalItems - 4) {
            currentPos++;
        } else {
            currentPos = 0;
        }
        updateSlider();
    }

    function slidePrev() {
        if (currentPos > 0) {
            currentPos--;
        } else {
            currentPos = Math.max(0, totalItems - 4);
        }
        updateSlider();
    }

    function updateSlider() {
        if (items.length > 0) {
            const itemWidth = items[0].offsetWidth;
            slider.style.transform = `translateX(-${currentPos * itemWidth}px)`;
        }
    }
    window.addEventListener('resize', updateSlider);
</script>
@endsection
