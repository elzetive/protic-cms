<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - UKM PROTIC PNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-[#F6FBF9] h-screen flex items-center justify-center overflow-hidden">

    <div class="bg-white w-[95%] max-w-6xl h-[90vh] rounded-[2.5rem] shadow-2xl flex overflow-hidden border border-gray-100">

        <div class="hidden md:block w-[50%] bg-[#0a362d] p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-amber-500/10 blur-[100px] rounded-full"></div>

            <div class="relative h-full w-full flex flex-col items-center justify-center text-center">
                <img src="{{ asset('img/isometric-regis.png') }}" class="w-[90%] h-auto relative z-10 drop-shadow-2xl animate-float">

                <div class="mt-6 relative z-10">
                    <h3 class="text-white font-black text-xl uppercase tracking-[0.2em]">Join Our Community</h3>
                    <p class="text-green-200/50 text-[10px] italic mt-2 tracking-widest">Start your journey with UKM PROTIC PNC</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-[50%] p-6 lg:p-10 flex flex-col relative overflow-y-auto md:overflow-hidden">
            <div class="flex items-center gap-3 mb-6">
                <img src="{{ asset('img/logo.png') }}" class="h-8 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-bold text-[10px] text-[#0a362d] uppercase">UKM PROTIC PNC</h1>
                    <p class="text-[8px] italic text-amber-600 font-medium tracking-wider">Improve Skill to Innovate</p>
                </div>
            </div>

            <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-black text-[#0a362d] uppercase tracking-wider mb-1">Buat Akun Baru</h2>
                    <p class="text-gray-400 text-[10px] italic">Lengkapi data di bawah untuk bergabung</p>
                </div>

                <form action="#" method="POST" class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                            <div class="relative group">
                                <i class="fa-solid fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                                <input type="text" placeholder="Nama Anda" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-9 pr-3 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Username</label>
                            <div class="relative group">
                                <i class="fa-solid fa-at absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                                <input type="text" placeholder="Username" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-9 pr-3 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Email</label>
                        <div class="relative group">
                            <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                            <input type="email" placeholder="contoh@pnc.ac.id" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-9 pr-3 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Password</label>
                            <div class="relative group">
                                <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                                <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-9 pr-9 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Konfirmasi</label>
                            <div class="relative group">
                                <i class="fa-solid fa-shield-check absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                                <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-9 pr-9 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-[#0a362d] text-white py-3 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] mt-2 hover:bg-[#082a23] transition-all hover:shadow-lg hover:shadow-[#0a362d]/20">
                        Daftar Sekarang
                    </button>
                </form>
            </div>

            <div class="mt-auto text-center pt-4">
                <p class="text-[10px] text-gray-400 font-medium">Sudah punya akun? <a href="#" class="text-[#0a362d] font-bold hover:underline">Masuk Sekarang</a></p>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>

</body>
</html>
