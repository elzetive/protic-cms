<header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 shrink-0 z-40">
    {{-- Button Toggle Sidebar --}}
    <button onclick="toggleSidebar()" class="text-gray-400 hover:text-[#0a362d] transition-all p-2 hover:bg-gray-50 rounded-xl">
        <i class="fa-solid fa-bars-staggered text-lg"></i>
    </button>

    {{-- Container Dropdown Akun --}}
    <div class="relative" id="dropdownContainer">
        {{-- Trigger Button --}}
        <button onclick="toggleAccount(event)" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-2xl transition-all group border border-transparent hover:border-gray-100 focus:outline-none">
            <div class="flex flex-col items-end">
                <span class="text-[#0a362d] font-black text-[11px] uppercase tracking-[0.1em] leading-none mb-1">Dimas Riyan</span>
                <span class="text-[9px] text-amber-600 font-black uppercase tracking-tighter">Administrator</span>
            </div>
            <div class="w-10 h-10 bg-[#0a362d] rounded-xl flex items-center justify-center text-white font-black border-2 border-white shadow-sm transition-all group-hover:scale-105 active:scale-95">
                D
            </div>
            <i id="chevronAccount" class="fa-solid fa-chevron-down text-[10px] text-gray-300 group-hover:text-[#0a362d] transition-transform duration-300 ease-in-out"></i>
        </button>

        {{-- Dropdown Menu --}}
        <div id="accountDropdown"
             class="hidden absolute right-0 mt-3 w-60 bg-white rounded-[1.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 py-3 z-[100] transform transition-all duration-200 opacity-0 scale-95 origin-top-right">

            <div class="px-5 py-3 border-b border-gray-50 mb-2">
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em]">Menu Akun</p>
            </div>

            <a href="#" class="flex items-center gap-3 px-5 py-3 text-[11px] font-black text-[#0a362d] uppercase tracking-wider hover:bg-gray-50 transition-colors group/item">
                <i class="fa-solid fa-gear w-5 text-center text-gray-300 group-hover/item:text-[#0a362d] transition-colors"></i> Pengaturan
            </a>

            <div class="mt-2 pt-2 border-t border-gray-50 px-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-[11px] font-black text-red-500 hover:bg-red-50 transition-all rounded-xl uppercase tracking-widest active:scale-95">
                        <i class="fa-solid fa-power-off w-5 text-center"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    /**
     * Fungsi untuk toggle buka/tutup dropdown akun
     */
    function toggleAccount(event) {
        // StopPropagation penting agar event klik tombol tidak lari ke window listener
        event.stopPropagation();

        const drop = document.getElementById('accountDropdown');
        const chevron = document.getElementById('chevronAccount');

        if (drop.classList.contains('hidden')) {
            openAccountDropdown(drop, chevron);
        } else {
            closeAccountDropdown(drop, chevron);
        }
    }

    /**
     * Logic membuka dropdown dengan transisi
     */
    function openAccountDropdown(drop, chevron) {
        drop.classList.remove('hidden');
        // Timeout 10ms agar transisi CSS opacity & scale berjalan
        setTimeout(() => {
            drop.classList.remove('opacity-0', 'scale-95');
            drop.classList.add('opacity-100', 'scale-100');
        }, 10);
        chevron.style.transform = "rotate(180deg)";
    }

    /**
     * Logic menutup dropdown dengan transisi
     */
    function closeAccountDropdown(drop, chevron) {
        if (!drop) drop = document.getElementById('accountDropdown');
        if (!chevron) chevron = document.getElementById('chevronAccount');

        drop.classList.remove('opacity-100', 'scale-100');
        drop.classList.add('opacity-0', 'scale-95');

        // Menunggu transisi 200ms selesai sebelum di-hidden
        setTimeout(() => {
            drop.classList.add('hidden');
        }, 200);
        chevron.style.transform = "rotate(0deg)";
    }

    /**
     * Menutup dropdown secara otomatis jika klik dilakukan di luar area dropdown
     */
    window.addEventListener('click', function(event) {
        const drop = document.getElementById('accountDropdown');
        const container = document.getElementById('dropdownContainer');

        // Jika klik terjadi di luar container dropdown, maka tutup
        if (!container.contains(event.target)) {
            if (!drop.classList.contains('hidden')) {
                closeAccountDropdown();
            }
        }
    });
</script>
