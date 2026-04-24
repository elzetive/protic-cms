<nav class="bg-[#0a362d] text-white p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-start items-center px-6">

        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10">
            <div>
                <h1 class="font-bold text-sm leading-tight">UKM PROTIC PNC</h1>
                <p class="text-[10px] italic text-green-200">Improve Skill to Innovate</p>
            </div>
        </div>

        <ul class="flex ml-40 gap-10 text-sm font-medium uppercase tracking-wider">
            <li class="relative group">
                <a href="{{ route('beranda') }}" class="hover:text-green-300 transition duration-300">Beranda</a>
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
            </li>

            <li class="relative group">
                <a href="{{ route('profil') }}" class="hover:text-green-300 transition duration-300">Profil</a>
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
            </li>

            <li class="relative group flex items-center gap-1">
                <a href="#" class="hover:text-green-300 transition duration-300">Divisi</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
            </li>

            <li class="relative group">
                <a href="#" class="hover:text-green-300 transition duration-300">Program Kerja</a>
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
            </li>

            <li class="relative group">
                <a href="#" class="hover:text-green-300 transition duration-300">Prestasi</a>
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full"></span>
            </li>
        </ul>

    </div>
</nav>
