<nav class="bg-[#0a362d] text-white p-4 sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-6">

        <div class="flex items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10">
                <div class="flex flex-col mr-16">
                    <h1 class="font-bold text-sm leading-tight uppercase text-white">UKM PROTIC PNC</h1>
                    <p class="text-[10px] italic text-amber-500 font-medium uppercase tracking-wide">Improve Skill to Innovate</p>
                </div>
            </div>

            <ul class="flex items-center gap-10 text-sm font-medium uppercase tracking-wider">
                <li class="relative group h-full flex items-center">
                    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'text-amber-400' : 'hover:text-green-300' }} transition duration-300">Beranda</a>
                    <span class="absolute -bottom-2 left-0 {{ request()->routeIs('beranda') ? 'w-full' : 'w-0' }} h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
                </li>

                <li class="relative group h-full flex items-center">
                    <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'text-amber-400' : 'hover:text-green-300' }} transition duration-300">Profil</a>
                    <span class="absolute -bottom-2 left-0 {{ request()->routeIs('profil') ? 'w-full' : 'w-0' }} h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
                </li>

                <li class="relative group h-full flex items-center py-2">
                    <div class="flex items-center gap-1 cursor-pointer {{ request()->routeIs('divisi.show') ? 'text-amber-400' : 'hover:text-green-300' }} transition duration-300">
                        <span>Divisi</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <span class="absolute bottom-0 left-0 {{ request()->routeIs('divisi.show') ? 'w-full' : 'w-0' }} h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>

                    <ul class="absolute left-0 top-full mt-0 w-64 bg-white text-[#0a362d] rounded-b-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 border-t-4 border-amber-500 overflow-hidden">
                        @php
                            // Slug disamakan persis dengan yang ada di DivisiController
                            $divisis = [
                                'badan-pengurus-harian' => 'Badan Pengurus Harian',
                                'divisi-kominfo'        => 'Divisi Kominfo',
                                'divisi-humas'          => 'Divisi Humas',
                                'divisi-web'            => 'Divisi Web',
                                'divisi-uiux'           => 'Divisi UI/UX',
                                'divisi-mobile'         => 'Divisi Mobile',
                                'divisi-data'           => 'Divisi Data',
                                'divisi-devops'         => 'Divisi Devops'
                            ];
                        @endphp
                        @foreach($divisis as $slug => $name)
                        <li>
                            <a href="{{ route('divisi.show', $slug) }}" class="block px-6 py-3 hover:bg-gray-100 hover:text-amber-600 transition border-b border-gray-50 text-xs font-bold uppercase {{ request()->fullUrlIs(route('divisi.show', $slug)) ? 'text-amber-600 bg-gray-50' : '' }}">
                                {{ $name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="relative group h-full flex items-center">
                    <a href="{{ route('proker') }}" class="{{ request()->routeIs('proker') ? 'text-amber-400' : 'hover:text-green-300' }} transition duration-300">Program Kerja</a>
                    <span class="absolute -bottom-2 left-0 {{ request()->routeIs('proker') ? 'w-full' : 'w-0' }} h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
                </li>

                <li class="relative group h-full flex items-center">
                    <a href="{{ route('prestasi') }}" class="{{ request()->routeIs('prestasi') ? 'text-amber-400' : 'hover:text-green-300' }} transition duration-300">Prestasi</a>
                    <span class="absolute -bottom-2 left-0 {{ request()->routeIs('prestasi') ? 'w-full' : 'w-0' }} h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
                </li>
            </ul>
        </div>

        <div class="flex items-center">
            @auth
                <a href="{{ route('admin.dashboard') }}" target="_blank" class="bg-white text-[#0a362d] px-5 py-2 rounded-xl text-xs font-bold hover:bg-amber-500 hover:text-white transition-all shadow-lg border-2 border-amber-500">
                    DASHBOARD
                </a>
            @else
                <a href="{{ route('admin.login') }}" class="bg-[#f59e0b] text-[#0a362d] px-5 py-2 rounded-xl text-xs font-bold hover:bg-white transition-all shadow-lg">
                    LOGIN
                </a>
            @endauth
        </div>
    </div>
</nav>
