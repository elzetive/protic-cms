<header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6 shrink-0 z-40">
    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" class="text-gray-400 hover:text-[#0a362d] transition-all p-2 hover:bg-gray-50 rounded-lg">
            <i class="fa-solid fa-bars-staggered text-lg"></i>
        </button>

        <div class="hidden sm:flex items-center gap-3">
            <span class="text-gray-300 text-sm">/</span>
            <h2 class="font-black text-[#0a362d] tracking-[0.15em] text-[11px] uppercase">
                @if(request()->routeIs('admin.dashboard')) Dashboard
                @elseif(request()->routeIs('admin.konten.*')) Konten
                @elseif(request()->routeIs('admin.database.*')) Database
                @elseif(request()->routeIs('admin.kas.*')) Kas Transaksi
                @elseif(request()->routeIs('admin.iuran.*')) Kas Iuran
                @elseif(request()->routeIs('admin.absensi.*')) Absensi
                @elseif(request()->routeIs('admin.arsip.*')) Arsip
                @else Admin Panel @endif
            </h2>
        </div>
    </div>

    <div class="relative" id="dropdownContainer">
        <button onclick="toggleAccount(event)" class="flex items-center gap-3 hover:bg-gray-50 p-1.5 pl-3 rounded-xl transition-all group border border-transparent hover:border-gray-100 focus:outline-none">
            <div class="flex flex-col items-end hidden sm:flex">
                <span class="text-[#0a362d] font-black text-[11px] leading-tight uppercase tracking-wider">
                    {{ Auth::user()->name }}
                </span>
                <span class="text-[9px] text-amber-600 font-bold uppercase tracking-tight">
                    Admin
                </span>
            </div>

            <div class="w-9 h-9 bg-[#0a362d] rounded-lg flex items-center justify-center text-white text-sm font-black border-2 border-white shadow-sm transition-all group-hover:scale-105 active:scale-95 uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <i id="chevronAccount" class="fa-solid fa-chevron-down text-[10px] text-gray-300 group-hover:text-[#0a362d] transition-transform duration-300"></i>
        </button>

        <div id="accountDropdown"
             class="hidden absolute right-0 mt-3 w-52 bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 py-2 z-[100] transform transition-all duration-200 opacity-0 scale-95 origin-top-right">

            <div class="px-5 py-2 border-b border-gray-50 mb-1">
                <p class="text-[9px] text-gray-400 font-black tracking-[0.2em] uppercase">Menu Akun</p>
            </div>

            <a href="#" class="flex items-center gap-3 px-5 py-2.5 text-[11px] font-black text-[#0a362d] tracking-wide hover:bg-gray-50 transition-colors group/item uppercase">
                <i class="fa-solid fa-gear w-5 text-center text-gray-300 group-hover/item:text-[#0a362d] text-sm"></i> Pengaturan
            </a>

            <div class="mt-1 pt-1 border-t border-gray-50 px-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-[11px] font-black text-red-500 hover:bg-red-50 transition-all rounded-lg tracking-wider active:scale-95 text-left uppercase">
                        <i class="fa-solid fa-power-off w-5 text-center text-sm"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
