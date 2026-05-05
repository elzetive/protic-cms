<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - UKM PROTIC PNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-[#F6FBF9] h-screen flex items-center justify-center overflow-hidden font-sans">

    <div class="bg-white w-[90%] max-w-6xl h-[85vh] rounded-[2.5rem] shadow-2xl flex overflow-hidden border border-gray-100">

        <div class="hidden md:flex w-[50%] bg-[#0a362d] p-10 relative overflow-hidden items-center justify-center flex-col text-center">
            <div class="absolute top-0 left-0 w-64 h-64 bg-amber-500/10 blur-[100px] rounded-full"></div>

            <img src="{{ asset('img/register.png') }}" class="w-[80%] h-auto relative z-10 drop-shadow-2xl animate-float" alt="Register Visual">

            <div class="mt-6 relative z-10">
                <h3 class="text-white font-black text-lg uppercase tracking-[0.2em]">Join Our Community</h3>
                <p class="text-green-200/50 text-[9px] italic mt-2 tracking-widest uppercase">Start your journey with UKM PROTIC PNC</p>
            </div>
        </div>

        <div class="w-full md:w-[50%] p-6 lg:p-10 flex flex-col justify-between relative">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" class="h-8 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-bold text-[10px] text-[#0a362d] uppercase tracking-tight">UKM PROTIC PNC</h1>
                    <p class="text-[8px] italic text-amber-600 font-medium leading-none">Improve Skill to Innovate</p>
                </div>
            </div>

            <div class="max-w-md mx-auto w-full">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-black text-[#0a362d] uppercase tracking-wider mb-1">Buat Akun</h2>
                    <p class="text-gray-400 text-[10px] italic">Lengkapi data pengurus untuk bergabung</p>
                </div>

<form action="{{ route('register.submit') }}" method="POST" class="space-y-3">                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                            <div class="relative group">
                                <i class="fa-solid fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                                <input type="text" name="name" required placeholder="Nama Anda" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-3 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Username</label>
                            <div class="relative group">
                                <i class="fa-solid fa-at absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                                <input type="text" name="username" required placeholder="Username" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-3 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Email UKM / PNC</label>
                        <div class="relative group">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                            <input type="email" name="email" required placeholder="contoh@pnc.ac.id" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-4 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Password</label>
                            <div class="relative group">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-4 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Konfirmasi</label>
                            <div class="relative group">
                                <i class="fa-solid fa-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                                <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-4 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#0a362d] text-white py-3 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] mt-2 hover:bg-[#082a23] transition-all active:scale-95 shadow-lg shadow-[#0a362d]/10">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-[9px] text-gray-400 font-medium tracking-tight">Sudah punya akun pengurus?
                        <a href="{{ route('admin.login') }}" class="text-amber-600 font-black hover:underline uppercase ml-1">Masuk</a>
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('beranda') }}" class="text-[9px] text-gray-400 font-bold hover:text-[#0a362d] uppercase tracking-widest transition-all">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
    </style>
</body>
</html>
