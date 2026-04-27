<footer class="bg-white pt-20 pb-8 border-t border-gray-100 relative overflow-hidden">
    <div class="absolute top-0 right-0 opacity-[0.03] pointer-events-none">
        <svg width="200" height="200" fill="currentColor" viewBox="0 0 20 20"><circle cx="2" cy="2" r="1"/><circle cx="7" cy="2" r="1"/><circle cx="12" cy="2" r="1"/><circle cx="17" cy="2" r="1"/><circle cx="2" cy="7" r="1"/><circle cx="7" cy="7" r="1"/><circle cx="12" cy="7" r="1"/><circle cx="17" cy="7" r="1"/><circle cx="2" cy="12" r="1"/><circle cx="7" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="17" cy="12" r="1"/></svg>
    </div>

    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 items-start">

            {{-- AKSES CEPAT --}}
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h4 class="font-black text-[#0a362d] mb-6 uppercase tracking-[0.2em] text-[10px] flex items-center gap-2">
                    <span class="w-2 h-[2px] bg-amber-500"></span> AKSES CEPAT
                </h4>
                <ul class="text-gray-500 space-y-3 text-sm font-medium italic uppercase">
                    <li><a href="{{ route('beranda') }}" class="hover:text-amber-500 transition-all hover:pl-2">BERANDA</a></li>
                    <li><a href="{{ route('profil') }}" class="hover:text-amber-500 transition-all hover:pl-2">PROFIL</a></li>
                    <li><a href="{{ route('proker') }}" class="hover:text-amber-500 transition-all hover:pl-2">PROGRAM KERJA</a></li>
                    <li><a href="{{ route('prestasi') }}" class="hover:text-amber-500 transition-all hover:pl-2">PRESTASI</a></li>
                </ul>
            </div>

            {{-- LOGO & SOCIALS --}}
            <div class="flex flex-col items-center">
                <div class="relative group mb-6">
                    <div class="absolute inset-0 bg-amber-500/10 blur-2xl rounded-full scale-0 group-hover:scale-150 transition-transform duration-700"></div>
                    <img src="{{ asset('img/logo.png') }}" class="h-20 w-auto relative z-10 transition-transform duration-500 group-hover:scale-110" alt="UKM PROTIC">
                </div>

                <p class="text-[10px] text-[#0a362d]/40 uppercase tracking-[0.4em] mb-8 font-black">
                    #IMPROVESKILLTOINOVATE
                </p>

                <div class="flex justify-center gap-4">
                    @php
                        $socials = [
                            ['icon' => 'instagram', 'url' => 'https://instagram.com/ukmproticpnc', 'color' => 'hover:bg-[#E1306C] hover:text-white'],
                            ['icon' => 'discord', 'url' => 'https://discord.gg/ukmproticpnc', 'color' => 'hover:bg-[#5865F2] hover:text-white'],
                            ['icon' => 'github', 'url' => 'https://github.com/UKM-PROTIC-PNC', 'color' => 'hover:bg-[#333] hover:text-white'],
                            ['icon' => 'linkedin', 'url' => 'https://linkedin.com/company/ukmproticpnc', 'color' => 'hover:bg-[#0077b5] hover:text-white'],
                            ['icon' => 'tiktok', 'url' => 'https://tiktok.com/@ukmproticpnc', 'color' => 'hover:bg-black hover:text-white'],
                        ];
                    @endphp

                    @foreach($socials as $soc)
                    <a href="{{ $soc['url'] }}" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 text-gray-400 {{ $soc['color'] }} transition-all duration-500 hover:-translate-y-2 hover:shadow-xl">
                        <i class="fa-brands fa-{{ $soc['icon'] }} text-lg"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- NARAHUBUNG --}}
            <div class="flex flex-col items-center md:items-end text-center md:text-right">
                <h4 class="font-black text-[#0a362d] mb-6 uppercase tracking-[0.2em] text-[10px] flex items-center gap-2 justify-end">
                    NARAHUBUNG <span class="w-2 h-[2px] bg-amber-500"></span>
                </h4>
                <div class="text-[13px] text-gray-500 space-y-4 font-medium italic uppercase">
                    <a href="mailto:UKM.PEMROGRAMAN@PNC.AC.ID" class="flex items-center gap-3 justify-center md:justify-end hover:text-[#0a362d] transition group">
                        <span class="order-2 md:order-1 tracking-tighter">UKM.PEMROGRAMAN@PNC.AC.ID</span>
                        <i class="fa-solid fa-envelope text-amber-500 order-1 md:order-2 group-hover:rotate-12 transition"></i>
                    </a>
                    <a href="https://WA.ME/6281226723902" target="_blank" class="flex items-center gap-3 justify-center md:justify-end hover:text-green-600 transition group">
                        <span class="order-2 md:order-1">+62 812-2672-3902 (DIMAS RIYAN)</span>
                        <i class="fa-brands fa-whatsapp text-green-500 text-lg order-1 md:order-2 group-hover:scale-110 transition"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="text-center mt-20 pt-8 border-t border-gray-50">
            <p class="text-[9px] text-gray-400 uppercase tracking-[0.6em] font-bold">
                COPYRIGHT © 2026 <span class="text-[#0a362d]">UKM PROTIC PNC</span>. <span class="hidden md:inline">ALL RIGHTS RESERVED.</span>
            </p>
        </div>
    </div>
</footer>
