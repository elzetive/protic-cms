@extends('layouts.app')

@section('title', $data['title'] . ' - UKM PROTIC PNC')

@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-bold text-[#0a362d] mb-6">{{ $data['title'] }}</h2>
            <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
            <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                {{ $data['desc'] }}
            </p>
        </div>
        <div class="md:w-1/2">
            <div class="relative group">
                <div class="absolute -top-4 -right-4 w-full h-full border-2 border-amber-500 rounded-xl z-0 transition-all group-hover:top-0 group-hover:right-0"></div>
                <img src="{{ asset('img/' . $data['img_group']) }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[350px]">
            </div>
        </div>
    </div>
</section>

<section class="py-24 {{ $data['bg_color'] }} relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16 text-white">
            <h2 class="text-5xl font-black tracking-widest uppercase mb-2">Our Team</h2>
            <p class="text-xl font-medium tracking-widest uppercase opacity-80">{{ $data['title'] }}</p>
        </div>

        <div class="relative max-w-6xl mx-auto group">
<div id="sliderViewport" class="overflow-hidden max-w-5xl mx-auto"> <div id="memberSlider" class="flex transition-transform duration-500 ease-in-out">
        @foreach($data['members'] as $member)
        <div class="member-item w-full sm:w-1/2 md:w-1/4 flex-shrink-0 px-3">
            <div class="bg-white/10 backdrop-blur-md p-3 rounded-2xl border border-white/20 shadow-2xl transition-transform hover:scale-105">
                <img src="{{ asset('img/member/' . $member['img']) }}" class="w-full aspect-[3/4] object-cover rounded-xl mb-4 pointer-events-none">
                <div class="text-center pb-4">
                    <h4 class="text-white font-bold italic text-sm uppercase tracking-wider">{{ $member['name'] }}</h4>
                    <p class="text-amber-400 text-[10px] font-bold uppercase tracking-widest">{{ $member['role'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
            <button onclick="slidePrev()" class="absolute -left-6 lg:-left-12 top-1/2 -translate-y-1/2 bg-white text-[#0a362d] w-12 h-12 rounded-full shadow-xl transition opacity-0 group-hover:opacity-100 hidden md:flex items-center justify-center hover:bg-amber-500 hover:text-white z-30">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button onclick="slideNext()" class="absolute -right-6 lg:-right-12 top-1/2 -translate-y-1/2 bg-white text-[#0a362d] w-12 h-12 rounded-full shadow-xl transition opacity-0 group-hover:opacity-100 hidden md:flex items-center justify-center hover:bg-amber-500 hover:text-white z-30">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
    let currentPos = 0;
    const slider = document.getElementById('memberSlider');
    const items = document.querySelectorAll('.member-item');
    const totalItems = items.length;

    function slideNext() {
        // Ganti angka 3 menjadi 4 sesuai jumlah foto yang tampil
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
            // Ganti angka 3 menjadi 4
            currentPos = totalItems - 4;
        }
        updateSlider();
    }

    function updateSlider() {
        const itemWidth = items[0].offsetWidth;
        slider.style.transform = `translateX(-${currentPos * itemWidth}px)`;
    }

    window.addEventListener('resize', updateSlider);
</script>
@endsection
