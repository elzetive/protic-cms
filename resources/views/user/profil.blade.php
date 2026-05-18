@extends('user.layouts.app')

@section('title', 'Profil - UKM PROTIC PNC')

@section('content')
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2 text-left">
                <h2 class="text-4xl font-bold text-[#0a362d] mb-6 tracking-wider">TENTANG KAMI</h2>
                <div class="w-20 h-1.5 bg-amber-500 mb-8 rounded-full"></div>
                <p class="text-gray-600 leading-relaxed text-lg text-justify italic">
                    Organisasi ini bernama Unit Kegiatan Mahasiswa PROGRAMMING TECHNOLOGY INFORMATICS CLUB yang disingkat menjadi UKM PROTIC yang didirikan pada 10 Oktober 2018 dengan nama UKM Pemrograman, lalu berganti nama menjadi UKM PROTIC pada Juli 2021. Sebagai organisasi di bawah naungan BEM Politeknik Negeri Cilacap, UKM PROTIC bertanggung jawab atas kegiatan, kepengurusan, dan anggota serta berfokus pada pengembangan minat dan bakat mahasiswa di bidang teknologi informasi.
                </p>
            </div>
            <div class="md:w-1/2">
                <div class="relative group">
                    <div class="absolute -top-4 -right-4 w-full h-full border-2 border-amber-500 rounded-xl z-0 transition-all duration-500 group-hover:top-0 group-hover:right-0"></div>
                    <img src="{{ asset('img/tentang-kami.JPG') }}" class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[400px]">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-6 lg:px-20 text-left">
            <h2 class="text-center text-4xl font-black text-[#0a362d] mb-16 tracking-widest uppercase">Visi & Misi</h2>
            <div class="grid md:grid-cols-2 gap-10">
                @foreach(['Visi', 'Misi'] as $type)
                <div class="bg-white p-10 rounded-3xl shadow-xl border-b-8 border-amber-500 transition-all duration-500 hover:bg-[#0a362d] group transform hover:-translate-y-3 relative overflow-hidden">
                    <div class="absolute -bottom-10 -right-10 text-9xl text-gray-100 opacity-20 group-hover:text-white group-hover:opacity-10 transition-all">
                        <i class="fa-solid fa-{{ $type == 'Visi' ? 'eye' : 'bullseye' }}"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-[#0a362d] mb-6 flex items-center gap-3 group-hover:text-amber-500 transition-colors">
                        <i class="fa-solid fa-{{ $type == 'Visi' ? 'eye' : 'bullseye' }} text-amber-500"></i> {{ $type }}
                    </h3>

                    <p class="text-gray-500 mb-8 font-medium italic leading-relaxed group-hover:text-gray-200 transition-colors text-sm text-left">
                        {{ $type == 'Visi' ? 'UKM PROTIC Politeknik Negeri Cilacap memiliki tujuan :' : 'Untuk mencapai tujuan tersebut UKM PROTIC mengimplementasikannya :' }}
                    </p>

                    <ul class="space-y-6 relative z-10">
                        @php
                            $items = $type == 'Visi' ? [
                                'Menjadikan UKM yang dapat menampung, menjadi wadah, serta memfasilitasi minat dan bakat mahasiswa.',
                                'Menyalurkan minat dan bakat mahasiswa di bidang pemrograman menjadi prestasi nasional maupun internasional.',
                                'Meningkatkan hard skill dan soft skill serta kolaborasi antar mahasiswa Politeknik Negeri Cilacap.'
                            ] : [
                                'Berorientasi pada subdivisi Web, Mobile, UI/UX, DevOps dan Data.',
                                'Mengadakan kegiatan rutin, diskusi dan sharing session untuk memperkaya pengetahuan.',
                                'Menjalin kerja sama internal maupun eksternal untuk optimasi potensi anggota.',
                                'Berpartisipasi aktif dalam kompetisi dan pelatihan pemrograman guna memperluas jaringan.'
                            ];
                        @endphp
                        @foreach($items as $item)
                        <li class="flex items-start gap-4 group/list">
                            <div class="mt-1 text-amber-500 group-hover/list:scale-125 transition-transform"><i class="fa-solid fa-circle-check text-sm"></i></div>
                            <p class="text-gray-600 leading-relaxed text-justify group-hover:text-gray-300 transition-colors text-sm">{{ $item }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <h2 class="text-4xl font-black text-[#0a362d] mb-20 tracking-widest uppercase">Our Goals</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @php
                    $goals = [
                        ['icon' => 'handshake-angle', 'title' => 'Accommodate', 'desc' => 'Wadah menampung, menjadi tempat, serta memfasilitasi minat dan bakat mahasiswa.'],
                        ['icon' => 'award', 'title' => 'Achievement', 'desc' => 'Menyalurkan minat di bidang pemrograman sehingga mampu mencetak prestasi dan nama baik kampus.'],
                        ['icon' => 'people-group', 'title' => 'Cooperation', 'desc' => 'Meningkatkan kemampuan kolaborasi bidang teknologi guna memperluas jaringan dan pengalaman.']
                    ];
                @endphp
                @foreach($goals as $goal)
                <div class="bg-white p-10 rounded-2xl border border-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl hover:-translate-y-3 hover:border-amber-500 group text-center">
                    <div class="text-[#0a362d] mb-6 text-5xl transition-all duration-300 group-hover:text-amber-500 group-hover:scale-110">
                        <i class="fa-solid fa-{{ $goal['icon'] }}"></i>
                    </div>
                    <h4 class="font-black text-[#0a362d] uppercase tracking-widest mb-4 text-base">#{{ $goal['title'] }}</h4>
                    <p class="text-gray-500 leading-relaxed text-sm group-hover:text-gray-700">
                        {{ $goal['desc'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 bg-gradient-to-br from-[#0a362d] via-[#082a23] to-[#041411]">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <h2 class="text-4xl font-black text-white mb-4 tracking-[0.4em] uppercase">Our Team</h2>
            <p class="text-amber-500 mb-20 font-medium italic opacity-80 uppercase">#ImproveSkillToInnovate</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($listDivisi as $div)
                    @php
                        $map = [
                            'BADAN PENGURUS HARIAN' => ['s' => 'badan-pengurus-harian', 'i' => 'badan-pengurus-harian.jpg'],
                            'DIVISI KOMINFO'        => ['s' => 'divisi-kominfo',        'i' => 'divisi-kominfo.jpg'],
                            'DIVISI HUMAS'          => ['s' => 'divisi-humas',          'i' => 'divisi-humas.jpg'],
                            'DIVISI WEB'            => ['s' => 'divisi-web',            'i' => 'divisi-web.jpg'],
                            'DIVISI UI/UX'          => ['s' => 'divisi-uiux',           'i' => 'divisi-uiux.jpg'],
                            'DIVISI MOBILE'         => ['s' => 'divisi-mobile',         'i' => 'divisi-mobile.jpg'],
                            'DIVISI DATA'           => ['s' => 'divisi-data',           'i' => 'divisi-data.jpg'],
                            'DIVISI DEVOPS'         => ['s' => 'divisi-devops',         'i' => 'divisi-devops.jpg'],
                        ];

                        $res = $map[$div->divisi] ?? ['s' => Str::slug($div->divisi), 'i' => 'default-team.jpg'];
                    @endphp

                    <a href="{{ url('/divisi/' . $res['s']) }}" class="group relative flex flex-col items-center">
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-6 aspect-[4/3] w-full bg-white/5 border border-white/10 p-2 transition-all duration-300 ease-out group-hover:border-amber-500/50 group-hover:-translate-y-2 will-change-transform">

                            <img src="{{ asset('img/' . $res['i']) }}"
                                 class="w-full h-full object-cover rounded-xl transition duration-500 transform-gpu group-hover:scale-105"
                                 alt="{{ $div->divisi }}"
                                 onerror="this.src='{{ asset('img/default-team.jpg') }}'">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a362d] via-transparent to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-300 pointer-events-none"></div>
                        </div>

                        <div class="text-center">
                            <h4 class="text-green-100 text-[11px] font-bold uppercase tracking-[0.2em] italic transition duration-300 group-hover:text-amber-400">
                                {{ $div->divisi }}
                            </h4>
                            <div class="w-0 h-[2px] bg-amber-500 mx-auto mt-2 transition-all duration-500 ease-in-out group-hover:w-full"></div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
