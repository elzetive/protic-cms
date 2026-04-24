<footer class="bg-white pt-12 pb-6 border-t border-gray-100">
    <div class="container mx-auto px-6 max-w-5xl grid grid-cols-1 md:grid-cols-3 gap-8 items-start text-center">

        <div class="flex flex-col items-center">
            <h4 class="font-bold text-[#0a362d] mb-4 relative inline-block uppercase tracking-widest text-xs">
                Akses Cepat
                <span class="block h-0.5 w-6 bg-amber-500 mx-auto mt-1 rounded-full"></span>
            </h4>
            <ul class="text-gray-500 space-y-2 text-sm font-medium">
                <li><a href="{{ route('beranda') }}" class="hover:text-amber-500 transition-colors">Beranda</a></li>
                <li><a href="{{ route('profil') }}" class="hover:text-amber-500 transition-colors">Profil</a></li>
                <li><a href="#" class="hover:text-amber-500 transition-colors">Divisi</a></li>
                <li><a href="#" class="hover:text-amber-500 transition-colors">Program Kerja</a></li>
                <li><a href="#" class="hover:text-amber-500 transition-colors">Prestasi</a></li>
            </ul>
        </div>

        <div class="flex flex-col items-center justify-center">
            <img src="{{ asset('img/logo.png') }}" class="h-16 mb-6 w-auto" alt="UKM PROTIC">
            <div class="flex justify-center gap-5 text-gray-400">
                <a href="https://instagram.com/ukmproticpnc" target="_blank" class="hover:text-[#E1306C] transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="https://discord.gg/ukmproticpnc" target="_blank" class="hover:text-[#5865F2] transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-discord text-xl"></i>
                </a>
                <a href="https://github.com/UKM-PROTIC-PNC" target="_blank" class="hover:text-[#333] transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-github text-xl"></i>
                </a>
                <a href="https://linkedin.com/company/ukmproticpnc" target="_blank" class="hover:text-[#0077b5] transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-linkedin text-xl"></i>
                </a>
                <a href="https://tiktok.com/@ukmproticpnc" target="_blank" class="hover:text-black transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-tiktok text-xl"></i>
                </a>
            </div>
        </div>

        <div class="flex flex-col items-center">
            <h4 class="font-bold text-[#0a362d] mb-4 relative inline-block uppercase tracking-widest text-xs">
                Narahubung
                <span class="block h-0.5 w-6 bg-amber-500 mx-auto mt-1 rounded-full"></span>
            </h4>
            <div class="text-[13px] text-gray-500 space-y-2 font-medium">
                <div class="flex items-center gap-2 justify-center hover:text-[#0a362d] transition cursor-default">
                    <i class="fa-solid fa-envelope text-[10px]"></i>
                    <span>ukm.pemrograman@pnc.ac.id</span>
                </div>
                <div class="flex items-center gap-2 justify-center text-gray-700">
                    <i class="fa-brands fa-whatsapp text-green-600 text-base"></i>
                    <span>+62 812-2672-3902 (Dimas Riyan)</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-12 pt-6 border-t border-gray-50">
        <p class="text-[9px] text-gray-400 uppercase tracking-[0.4em] font-medium">
            Copyright © 2026 <span class="text-[#0a362d] font-bold">UKM PROTIC PNC</span>
             All Right Reserved.
        </p>
    </div>
</footer>
