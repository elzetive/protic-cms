@extends('layouts.app')

@section('title', 'Profil - UKM PROTIC PNC')

@section('content')
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-bold text-[#0a362d] mb-6">Tentang Kami</h2>
                <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
                <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                    Organisasi ini bernama Unit Kegiatan Mahasiswa PROGRAMMING TECHNOLOGY INFORMATICS CLUB yang disingkat menjadi UKM PROTIC yang didirikan pada 10 Oktober 2018 dengan nama UKM Pemrograman, lalu berganti nama menjadi UKM PROTIC pada Juli 2021. Sebagai organisasi di bawah naungan BEM Politeknik Negeri Cilacap, UKM PROTIC bertanggung jawab atas kegiatan, kepengurusan, dan anggota serta berfokus pada pengembangan minat dan bakat mahasiswa di bidang teknologi informasi.
                </p>
            </div>
            <div class="md:w-1/2">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-full h-full border-2 border-amber-500 rounded-xl z-0"></div>
                    <img src="{{ asset('img/tentang-kami.JPG') }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[400px]">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-20">
            <h2 class="text-center text-4xl font-black text-[#0a362d] mb-16 tracking-widest uppercase">Visi & Misi</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="bg-white p-10 rounded-2xl shadow-xl border-b-8 border-amber-500 transition-all duration-500 hover:bg-[#0a362d] group transform hover:-translate-y-2">
                    <h3 class="text-2xl font-bold text-[#0a362d] mb-6 flex items-center gap-3 group-hover:text-amber-500 transition-colors">
                        <i class="fa-solid fa-eye text-amber-500"></i> Visi
                    </h3>
                    <p class="text-gray-500 mb-8 font-medium italic leading-relaxed group-hover:text-gray-200 transition-colors">
                        Unit Kegiatan Mahasiswa Programming Technology Informatics Club Politeknik Negeri Cilacap memiliki tujuan, yaitu :
                    </p>
                    <ul class="space-y-6">
                        @foreach([
                            'Menjadikan Unit Kegiatan Mahasiswa yang dapat menampung, menjadi wadah, serta memfasilitasi minat dan bakat mahasiswa dalam pengembangan diri mahasiswa Politeknik Negeri Cilacap.',
                            'Menyalurkan minat dan bakat mahasiswa di bidang pemrograman komputer menjadi sebuah prestasi baik di tingkat perguruan tinggi, regional, nasional, maupun internasional sehingga memberikan nama baik bagi Politeknik Negeri Cilacap.',
                            'Meningkatkan hard skill dan soft skill dalam diri serta mampu berkolaborasi kemampuan bidang pemrograman antar mahasiswa Politeknik Negeri Cilacap.'
                        ] as $visi)
                        <li class="flex items-start gap-4">
                            <div class="mt-1 text-amber-500"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            <p class="text-gray-600 leading-relaxed text-justify group-hover:text-gray-300 transition-colors">{{ $visi }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-10 rounded-2xl shadow-xl border-b-8 border-amber-500 transition-all duration-500 hover:bg-[#0a362d] group transform hover:-translate-y-2">
                    <h3 class="text-2xl font-bold text-[#0a362d] mb-6 flex items-center gap-3 group-hover:text-amber-500 transition-colors">
                        <i class="fa-solid fa-bullseye text-amber-500"></i> Misi
                    </h3>
                    <p class="text-gray-500 mb-8 font-medium italic leading-relaxed group-hover:text-gray-200 transition-colors">
                        Untuk mencapai tujuan tersebut UKM PROTIC mengimplementasikannya :
                    </p>
                    <ul class="space-y-6">
                        @foreach([
                            'Dengan berorientasi pada bidang pemrograman melalui subdivisi yang meliputi Web, Mobile, UI/UX, DevOps dan Data.',
                            'UKM PROTIC akan mengadakan kegiatan rutin seperti pertemuan anggota, diskusi dan sharing session untuk memperkaya pengetahuan dan pengalaman di bidang pemograman.',
                            'UKM PROTIC akan menjalinkan kerja sama dengan pihak lain baik internal maupun eksternal kampus untuk mengoptiomalkan pengembangan potensi anggotanya.',
                            'UKM PROTIC berusaha untuk berpatisipasi dalam kompetisi, pelatihan atau acara lainnya yang berkaitan dengan pemrograman guna untuk meningkatkan kemampuan dan memperluas jaringan anggotanya.'
                        ] as $misi)
                        <li class="flex items-start gap-4">
                            <div class="mt-1 text-amber-500"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            <p class="text-gray-600 leading-relaxed text-justify group-hover:text-gray-300 transition-colors">{{ $misi }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 lg:px-20 text-center">
        <h2 class="text-4xl font-black text-[#0a362d] mb-20 tracking-widest uppercase">Our Goals</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 hover:border-amber-500 group">
                <div class="text-[#0a362d] mb-6 text-5xl transition-colors duration-300 group-hover:text-amber-500">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
                <h4 class="font-black text-[#0a362d] uppercase tracking-widest mb-4 text-base">Accommodate</h4>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Wadah dapat menampung, menjadi tempat, serta memfasilitasi minat dan bakat mahasiswa dalam pengembangan diri mahasiswa.
                </p>
            </div>

            <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 hover:border-amber-500 group">
                <div class="text-[#0a362d] mb-6 text-5xl transition-colors duration-300 group-hover:text-amber-500">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h4 class="font-black text-[#0a362d] uppercase tracking-widest mb-4 text-base">Achievement</h4>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Menyalurkan minat dan bakat mahasiswa di bidang pemrograman sehingga mampu mencetak prestasi dan membawa nama baik kampus.
                </p>
            </div>

            <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 hover:border-amber-500 group">
                <div class="text-[#0a362d] mb-6 text-5xl transition-colors duration-300 group-hover:text-amber-500">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <h4 class="font-black text-[#0a362d] uppercase tracking-widest mb-4 text-base">Cooperation</h4>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Meningkatkan kemampuan kolaborasi antar mahasiswa dalam bidang teknologi guna memperluas jaringan dan pengalaman.
                </p>
            </div>

        </div>
    </div>
</section>
<section class="py-24 bg-[#0a362d]">
    <div class="container mx-auto px-6 lg:px-20 text-center">
        <h2 class="text-4xl font-black text-white mb-4 tracking-[0.4em] uppercase">Our Team</h2>
        <p class="text-green-200 mb-20 font-medium italic">#ImproveSkilltoInovate</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @php
                $teams = [
                    ['name' => 'Badan Pengurus Harian', 'img' => 'bph.jpg'],
                    ['name' => 'Divisi Kominfo', 'img' => 'kominfo.jpg'],
                    ['name' => 'Divisi Humas', 'img' => 'humas.jpg'],
                    ['name' => 'Divisi Web', 'img' => 'web.jpg'],
                    ['name' => 'Divisi UI/UX', 'img' => 'uiux.jpg'],
                    ['name' => 'Divisi Mobile', 'img' => 'mobile.jpg'],
                    ['name' => 'Divisi Data', 'img' => 'data.jpg'],
                    ['name' => 'Divisi Devops', 'img' => 'devops.jpg'],
                ];
            @endphp

            @foreach($teams as $team)
            <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-6 aspect-[4/3]">
                    <img src="{{ asset('img/'.$team['img']) }}"
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>

                <div class="relative inline-block px-1">
                    <h4 class="text-green-100 text-sm font-semibold italic uppercase tracking-wider transition duration-300">
                        {{ $team['name'] }}
                    </h4>
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
