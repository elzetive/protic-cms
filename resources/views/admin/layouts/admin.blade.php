<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - UKM PROTIC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        #adminSidebar, .flex-grow, .sidebar-text, .sidebar-logo-container {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-collapsed { width: 88px !important; } {{-- Dilebarin dikit dari 80px --}}
        .sidebar-collapsed .sidebar-text { display: none !important; }
        .sidebar-collapsed .sidebar-justify-center,
        .sidebar-collapsed .sidebar-link-justify {
            justify-content: center !important;
            padding: 0 !important;
            width: 56px;
            margin: 0 auto;
        }

        .sidebar-collapsed #iconKas { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }

        .custom-scroll::-webkit-scrollbar { width: 8px; } {{-- Scrollbar agak tebelan --}}
        .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #0a362d; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8faf9] flex h-screen overflow-hidden">

    @include('admin.partials.sidebar')

    <div class="flex-grow flex flex-col min-w-0 overflow-hidden uppercase">

        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0 z-40">

            <div class="flex items-center gap-6"> {{-- Gap dibesarin --}}
                <button onclick="toggleSidebar()" class="text-gray-400 hover:text-[#0a362d] transition-all p-2.5 hover:bg-gray-50 rounded-xl">
                    <i class="fa-solid fa-bars-staggered text-xl"></i> {{-- Icon lebih gede --}}
                </button>
                <div class="hidden sm:flex items-center gap-3">
                    <span class="text-gray-300 text-sm">/</span> {{-- Font size naik --}}
                    <h2 class="font-black text-[#0a362d] tracking-[0.2em] text-[12px]"> {{-- Naikan ke 12px --}}
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
                <button onclick="toggleAccount(event)" class="flex items-center gap-4 hover:bg-gray-50 p-2.5 rounded-2xl transition-all group border border-transparent hover:border-gray-100 focus:outline-none">
                    <div class="flex flex-col items-end hidden sm:flex">
                        <span class="text-[#0a362d] font-black text-[12px] leading-none mb-1.5">Dimas Riyan</span>
                        <span class="text-[10px] text-amber-600 font-black tracking-tighter">Administrator</span>
                    </div>
                    <div class="w-11 h-11 bg-[#0a362d] rounded-xl flex items-center justify-center text-white text-base font-black border-2 border-white shadow-sm transition-all group-hover:scale-105 active:scale-95">
                        D
                    </div>
                    <i id="chevronAccount" class="fa-solid fa-chevron-down text-xs text-gray-300 group-hover:text-[#0a362d] transition-transform duration-300 ease-in-out"></i>
                </button>

                <div id="accountDropdown"
                     class="hidden absolute right-0 mt-4 w-64 bg-white rounded-[1.5rem] border border-gray-100 shadow-xl shadow-gray-200/50 py-4 z-[100] transform transition-all duration-200 opacity-0 scale-95 origin-top-right">

                    <div class="px-6 py-3 border-b border-gray-50 mb-3">
                        <p class="text-[10px] text-gray-400 font-black tracking-[0.2em]">Menu Akun</p>
                    </div>

                    <a href="#" class="flex items-center gap-4 px-6 py-4 text-[12px] font-black text-[#0a362d] tracking-wider hover:bg-gray-50 transition-colors group/item">
                        <i class="fa-solid fa-gear w-6 text-center text-gray-300 group-hover/item:text-[#0a362d] transition-colors text-base"></i> Pengaturan
                    </a>

                    <div class="mt-3 pt-3 border-t border-gray-50 px-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 text-[12px] font-black text-red-500 hover:bg-red-50 transition-all rounded-xl tracking-widest active:scale-95 text-left">
                                <i class="fa-solid fa-power-off w-6 text-center text-base"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow overflow-y-auto p-10 custom-scroll bg-[#fcfcfc]"> {{-- Padding p-10 biar lebih lega --}}
            <div class="max-w-7xl mx-auto animate-in fade-in duration-500">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('sidebar-collapsed');
        }

        function toggleAccount(event) {
            event.stopPropagation();
            const drop = document.getElementById('accountDropdown');
            const chevron = document.getElementById('chevronAccount');

            if (drop.classList.contains('hidden')) {
                drop.classList.remove('hidden');
                setTimeout(() => {
                    drop.classList.remove('opacity-0', 'scale-95');
                    drop.classList.add('opacity-100', 'scale-100');
                }, 10);
                chevron.style.transform = "rotate(180deg)";
            } else {
                closeAccountDropdown();
            }
        }

        function closeAccountDropdown() {
            const drop = document.getElementById('accountDropdown');
            const chevron = document.getElementById('chevronAccount');
            if (drop && !drop.classList.contains('hidden')) {
                drop.classList.remove('opacity-100', 'scale-100');
                drop.classList.add('opacity-0', 'scale-95');
                setTimeout(() => { drop.classList.add('hidden'); }, 200);
                chevron.style.transform = "rotate(0deg)";
            }
        }

        window.addEventListener('click', function(event) {
            const container = document.getElementById('dropdownContainer');
            if (container && !container.contains(event.target)) {
                closeAccountDropdown();
            }
        });

        function toggleDropdown(id) {
            const sidebar = document.getElementById('adminSidebar');
            if (sidebar.classList.contains('sidebar-collapsed')) return;

            const drop = document.getElementById(id);
            const icon = document.getElementById('iconKas');
            if(drop) drop.classList.toggle('hidden');
            if(icon) icon.classList.toggle('rotate-180');
        }
    </script>
</body>
</html>
