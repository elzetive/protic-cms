<aside id="adminSidebar" class="w-64 bg-white flex flex-col h-screen transition-all duration-300 ease-in-out shrink-0 z-50 border-r border-gray-100 shadow-sm sticky top-0">

    <div class="h-24 flex items-center sidebar-logo-container border-b border-gray-50 transition-all duration-300">
        <div class="flex items-center gap-4 sidebar-justify-center w-full px-6">
            <img src="{{ asset('img/logo.png') }}" class="h-12 w-auto object-contain transition-transform duration-300 hover:scale-110 shrink-0">
            <div class="flex flex-col sidebar-text whitespace-nowrap">
                <span class="text-[#0a362d] font-black text-[14px] leading-tight uppercase tracking-[0.15em] text-left">UKM PROTIC PNC</span>
                <span class="text-[9px] italic text-[#f59e0b] font-extrabold tracking-widest text-left mt-0.5">IMPROVE SKILL TO INNOVATE</span>
            </div>
        </div>
    </div>

    <nav class="flex-grow py-6 overflow-y-auto no-scrollbar space-y-2 px-4">
        @php
            function getMenuClass($isActive) {
                return $isActive
                    ? 'bg-[#0a362d] text-white font-black shadow-lg shadow-[#0a362d]/20'
                    : 'text-[#0a362d]/60 hover:text-[#0a362d] hover:bg-gray-50 font-black';
            }
        @endphp

        <div class="relative group">
            @if(request()->routeIs('admin.dashboard'))
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <a href="{{ route('admin.dashboard') }}" class="flex items-center sidebar-link-justify gap-3 px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ getMenuClass(request()->routeIs('admin.dashboard')) }}">
                <i class="fa-solid fa-house-chimney w-5 text-center shrink-0"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </div>

        <div class="relative group">
            @if(request()->routeIs('admin.konten.*'))
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <a href="{{ route('admin.konten.index') }}" class="flex items-center sidebar-link-justify gap-3 px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ getMenuClass(request()->routeIs('admin.konten.*')) }}">
                <i class="fa-solid fa-layer-group w-5 text-center shrink-0"></i>
                <span class="sidebar-text">Konten</span>
            </a>
        </div>

        <div class="relative group">
            @if(request()->routeIs('admin.database.*'))
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <a href="{{ route('admin.database.index') }}" class="flex items-center sidebar-link-justify gap-3 px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ getMenuClass(request()->routeIs('admin.database.*')) }}">
                <i class="fa-solid fa-database w-5 text-center shrink-0"></i>
                <span class="sidebar-text">Database</span>
            </a>
        </div>

        <div class="relative group">
            @php $isKasActive = request()->routeIs('admin.kas.*') || request()->routeIs('admin.iuran.*'); @endphp
            @if($isKasActive)
                <div class="absolute -left-4 top-5 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <button onclick="toggleDropdown('dropKas')" class="w-full flex items-center justify-between sidebar-link-justify px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ $isKasActive ? 'bg-[#0a362d] text-white font-black shadow-lg shadow-[#0a362d]/20' : 'text-[#0a362d]/60 hover:text-[#0a362d] hover:bg-gray-50 font-black' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-wallet w-5 text-center shrink-0"></i>
                    <span class="sidebar-text">Kas</span>
                </div>
                <i id="iconKas" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 sidebar-text {{ $isKasActive ? 'rotate-180 text-white' : '' }}"></i>
            </button>
            <div id="dropKas" class="{{ $isKasActive ? 'block' : 'hidden' }} mt-2 space-y-1 sidebar-text">
                <a href="{{ route('admin.kas.index') }}" class="flex items-center pl-14 py-2.5 rounded-xl text-[10px] uppercase transition-all {{ request()->routeIs('admin.kas.*') ? 'text-[#0a362d] font-black' : 'text-[#0a362d]/50 hover:text-[#0a362d]' }}">
                    <div class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.kas.*') ? 'bg-[#f59e0b]' : 'bg-gray-300' }}"></div> Transaksi
                </a>
                <a href="{{ route('admin.iuran.index') }}" class="flex items-center pl-14 py-2.5 rounded-xl text-[10px] uppercase transition-all {{ request()->routeIs('admin.iuran.*') ? 'text-[#0a362d] font-black' : 'text-[#0a362d]/50 hover:text-[#0a362d]' }}">
                    <div class="w-1.5 h-1.5 rounded-full mr-3 {{ request()->routeIs('admin.iuran.*') ? 'bg-[#f59e0b]' : 'bg-gray-300' }}"></div> Iuran
                </a>
            </div>
        </div>

        <div class="relative group">
            @if(request()->routeIs('admin.absensi.*'))
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <a href="{{ route('admin.absensi.index') }}" class="flex items-center sidebar-link-justify gap-3 px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ getMenuClass(request()->routeIs('admin.absensi.*')) }}">
                <i class="fa-solid fa-clipboard-user w-5 text-center shrink-0"></i>
                <span class="sidebar-text">Absensi</span>
            </a>
        </div>

        <div class="relative group">
            {{-- Deteksi status aktif jika berada di menu arsip indeks ataupun pembuatan surat --}}
            @php $isArsipActive = request()->routeIs('admin.arsip.*'); @endphp
            @if($isArsipActive)
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-[#f59e0b] rounded-r-full z-10"></div>
            @endif
            <a href="{{ route('admin.arsip.index') }}" class="flex items-center sidebar-link-justify gap-3 px-5 py-3 rounded-xl text-[11px] uppercase tracking-[0.1em] transition-all duration-200 {{ getMenuClass($isArsipActive) }}">
                <i class="fa-solid fa-box-archive w-5 text-center shrink-0"></i>
                <span class="sidebar-text">Arsip</span>
            </a>
        </div>
    </nav>

    <div class="p-4 border-t border-gray-50">
        <a href="{{ route('beranda') }}" target="_blank"
           class="flex items-center sidebar-link-justify gap-3 px-5 py-4 text-[#0a362d]/50 hover:text-[#f59e0b] transition-all group bg-gray-50/50 rounded-2xl"
           title="Lihat Website">
            <i class="fa-solid fa-earth-asia group-hover:rotate-180 transition-transform duration-700 text-center w-5 shrink-0"></i>

            <span class="sidebar-text text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap">
                Lihat Website
            </span>
        </a>
    </div>
</aside>

<script>
    function toggleDropdown(id) {
        const drop = document.getElementById(id);
        const icon = document.getElementById('iconKas');
        drop.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
