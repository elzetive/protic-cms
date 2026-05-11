<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABSENSI PROTIC - {{ $kegiatan->nama_kegiatan }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .ts-control {
            border: none !important;
            padding: 1rem 1.5rem !important;
            border-radius: 1.25rem !important;
            background-color: #f9fafb !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            color: #0a362d !important;
            box-shadow: none !important;
        }
        .ts-dropdown {
            border-radius: 1.25rem !important;
            border: 1px solid #f3f4f6 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            padding: 0.5rem !important;
        }
        .ts-dropdown .active {
            background-color: #0a362d !important;
            color: white !important;
            border-radius: 0.75rem !important;
        }
    </style>
</head>
<body class="bg-[#f8faf9] flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-2xl shadow-[#0a362d]/10 p-10 border border-gray-100 animate-in fade-in zoom-in duration-500 relative overflow-hidden">

        <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-50 rounded-full opacity-50 blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-amber-50 rounded-full opacity-50 blur-3xl"></div>

        <div class="relative">
            <div class="w-20 h-20 bg-[#0a362d] rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-[#0a362d]/20 rotate-3 transition-transform hover:rotate-0">
                <i class="fa-solid fa-user-check text-3xl text-white"></i>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-extrabold text-[#0a362d] uppercase tracking-tighter leading-tight">Presensi Pengurus</h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-2 italic">PROTIC PNC System</p>
            </div>

            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-5 mb-8 text-left">
                <div class="flex items-start gap-4">
                    <div class="bg-white w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 shadow-sm border border-gray-100">
                        <i class="fa-solid fa-calendar-day text-amber-500 text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-[11px] font-black text-[#0a362d] uppercase tracking-wide truncate">{{ $kegiatan->nama_kegiatan }}</h4>
                        <p class="text-[9px] text-gray-400 font-bold uppercase mt-1">
                            <i class="fa-solid fa-location-dot mr-1 text-emerald-500"></i> {{ $kegiatan->lokasi }}
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('absensi.submit') }}" method="POST" class="space-y-6 text-left">
                @csrf
                <input type="hidden" name="token" value="{{ $kegiatan->token_absensi }}">
                <input type="hidden" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}">

                <div class="space-y-2">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Cari & Pilih Nama Anda</label>

                    <select name="nama" id="select-pengurus" required placeholder="KETIK NAMA LENGKAP...">
                        <option value="">PILIH NAMA</option>
                        @foreach($daftarPengurus as $p)
                            <option value="{{ $p->nama_mhs }}">{{ strtoupper($p->nama_mhs) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-[#0a362d] text-white py-5 rounded-[2rem] text-xs font-black uppercase tracking-widest shadow-xl shadow-[#0a362d]/20 active:scale-95 transition-all hover:bg-amber-600 flex items-center justify-center gap-3">
                    Konfirmasi Hadir <i class="fa-solid fa-check-double text-[10px]"></i>
                </button>
            </form>

            <p class="text-center text-[8px] text-gray-300 font-bold uppercase tracking-[0.3em] mt-10">
                &copy; {{ date('Y') }} UKM PROTIC PNC
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect('#select-pengurus', {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: "KETIK NAMA ANDA...",
                allowEmptyOption: false,
            });
        });
    </script>
</body>
</html>
