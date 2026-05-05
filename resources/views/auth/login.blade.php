<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKM PROTIC PNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#F6FBF9] h-screen flex items-center justify-center overflow-hidden font-sans">

    <div class="bg-white w-[90%] max-w-6xl h-[85vh] rounded-[2.5rem] shadow-2xl flex overflow-hidden border border-gray-100">

        <div class="w-full md:w-[45%] p-6 lg:p-10 flex flex-col justify-between relative">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" class="h-8 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-bold text-[10px] text-[#0a362d] uppercase tracking-tight">UKM PROTIC PNC</h1>
                    <p class="text-[8px] italic text-amber-600 font-medium leading-none">Improve Skill to Innovate</p>
                </div>
            </div>

            <div class="max-w-sm mx-auto w-full">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-black text-[#0a362d] uppercase tracking-wider mb-1">Selamat Datang</h2>
                    <p class="text-gray-400 text-[10px] italic">Masukkan data admin Anda</p>
                </div>

                @if($errors->any())
                    <div class="mb-4 p-2 bg-rose-50 border-l-4 border-rose-500 text-rose-600 text-[9px] font-bold uppercase rounded-r-lg">
                        {{ $errors->first() }}
                    </div>
                @endif

<form action="{{ route('login.submit') }}" method="POST" class="space-y-3">                    @csrf
<div>
    <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Email / Username</label>
    <div class="relative group">
        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>

        <input type="text" name="login" value="{{ old('login') }}" required placeholder="Email atau Username" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-4 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
    </div>
</div>
                    <div>
                        <label class="block text-[9px] font-black text-[#0a362d] uppercase tracking-widest mb-1 ml-1">Password</label>
                        <div class="relative group">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-amber-500 text-[10px]"></i>
                            <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-200 py-2.5 pl-10 pr-10 rounded-xl text-xs focus:outline-none focus:border-amber-500 transition-all">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500">
                                <i id="eye-icon" class="fa-solid fa-eye-slash text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center px-1 text-[9px]">
                        <div class="flex items-center gap-1.5">
                            <input type="checkbox" id="remember" class="w-3 h-3 rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                            <label for="remember" class="font-bold text-gray-400 uppercase cursor-pointer">Ingat Saya</label>
                        </div>
                        <a href="#" class="font-bold text-[#0a362d] hover:text-amber-600 uppercase italic tracking-tighter">Lupa Password?</a>
                    </div>

                    <button type="submit" class="w-full bg-[#0a362d] text-white py-3 rounded-xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-[#082a23] transition-all active:scale-95 shadow-lg shadow-[#0a362d]/10">
                        Masuk
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-[9px] text-gray-400 font-medium">Belum punya akun?
                        <a href="{{ route('register') }}" class="text-amber-600 font-black hover:underline uppercase ml-1">Daftar Akun</a>
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('beranda') }}" class="text-[9px] text-gray-400 font-bold hover:text-[#0a362d] uppercase tracking-widest transition-all">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        <div class="hidden md:flex w-[55%] bg-[#0a362d] p-10 relative overflow-hidden flex-col items-center justify-center text-center">
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-500/10 blur-[100px] rounded-full"></div>

            <img src="{{ asset('img/login.png') }}" class="w-[80%] h-auto relative z-10 drop-shadow-2xl animate-float" alt="PROTIC Visual">

<div class="mt-8 relative z-10">
    <h3 class="text-white font-black text-xl uppercase tracking-[0.2em]">Inovasi Tanpa Batas</h3>
    <p class="text-green-200/50 text-[10px] italic mt-2 tracking-widest uppercase">Empowering Digital Creativity with PROTIC</p>
</div>        </div>
    </div>

    <script>
        function togglePassword() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passInput.type = 'password';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>
