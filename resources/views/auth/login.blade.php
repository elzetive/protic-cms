<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKM PROTIC PNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-[#F6FBF9] h-screen flex items-center justify-center overflow-hidden">

    <div class="bg-white w-[90%] max-w-6xl h-[85vh] rounded-[2.5rem] shadow-2xl flex overflow-hidden border border-gray-100">

        {{-- Sisi Kiri: Form Login --}}
        <div class="w-full md:w-[45%] p-8 lg:p-12 flex flex-col relative">
            {{-- Logo & Header Kecil --}}
            <div class="flex items-center gap-3 mb-12">
                <img src="{{ asset('img/logo.png') }}" class="h-10 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-bold text-xs text-[#0a362d] uppercase">UKM PROTIC PNC</h1>
                    <p class="text-[9px] italic text-amber-600 font-medium tracking-wider">Improve Skill to Innovate</p>
                </div>
            </div>

            {{-- Form Area --}}
            <div class="flex-grow flex flex-col justify-center max-w-sm mx-auto w-full">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-[#0a362d] uppercase tracking-wider mb-2">Selamat Datang</h2>
                    <p class="text-gray-400 text-xs italic">Masukkan data admin Anda untuk mengelola sistem</p>
                </div>

                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5 ml-1">Username</label>
                        <div class="relative group">
                            <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 transition-colors"></i>
                            <input type="text" placeholder="Masukkan username admin" class="w-full bg-gray-50 border border-gray-200 py-3 pl-12 pr-4 rounded-xl text-sm focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#0a362d] uppercase tracking-widest mb-1.5 ml-1">Password</label>
                        <div class="relative group">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 transition-colors"></i>
                            <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-3 pl-12 pr-12 rounded-xl text-sm focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500">
                                <i class="fa-solid fa-eye-slash text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="#" class="text-[10px] font-bold text-[#0a362d] hover:text-amber-600 transition uppercase tracking-widest italic">Lupa Password?</a>
                    </div>

                    <button type="submit" class="w-full bg-[#0a362d] text-white py-3.5 rounded-xl font-black uppercase tracking-[0.2em] text-xs hover:bg-[#082a23] transition-all hover:shadow-lg hover:shadow-[#0a362d]/20 active:scale-95">
                        Masuk
                    </button>
                </form>
            </div>

            <div class="mt-auto text-center">
                <p class="text-[10px] text-gray-400 font-medium">Bukan Admin? <a href="{{ route('beranda') }}" class="text-[#0a362d] font-bold hover:underline">Kembali</a></p>
            </div>
        </div>

        <div class="hidden md:block w-[55%] bg-[#0a362d] p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-500/10 blur-[100px] rounded-full"></div>

            <div class="relative h-full w-full flex items-center justify-center">
                <img src="{{ asset('img/login.png') }}" class="w-[85%] h-auto relative z-10 drop-shadow-2xl" alt="PROTIC Logo">
            </div>
        </div>
    </div>

</body>
</html>
