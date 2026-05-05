@extends('admin.layouts.admin')

@section('content')
<style> [x-cloak] { display: none !important; } </style>

<div class="space-y-6 animate-in fade-in duration-700" x-data="{ kategori: 'menu' }">

    @if(session('success'))
        <div id="alert-success" class="fixed top-24 right-10 z-[100] transform transition-all duration-500">
            <div class="bg-[#0a362d] border-l-4 border-amber-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
                <div class="bg-amber-500/20 p-2 rounded-lg">
                    <i class="fa-solid fa-circle-check text-amber-500 text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1">BERHASIL!</p>
                    <p class="text-[11px] font-medium italic opacity-90 uppercase tracking-wider">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 opacity-50 hover:opacity-100">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-success');
                if(alert) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(20px)';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Manajemen Konten</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                <template x-if="kategori === 'menu'">
                    <span>Pilih kategori untuk mengelola data website</span>
                </template>
                <template x-if="kategori !== 'menu'">
                    <span>Manajemen List: <span x-text="kategori"></span> PROTIC</span>
                </template>
            </p>
        </div>
        <div class="flex gap-3">
            <button x-show="kategori !== 'menu'" @click="kategori = 'menu'" x-cloak class="bg-white border border-gray-200 text-[#0a362d] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all active:scale-95">
                <i class="fa-solid fa-arrow-left mr-2"></i> KEMBALI
            </button>
            <a href="{{ route('admin.konten.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95">
                <i class="fa-solid fa-plus mr-2"></i> TAMBAH KONTEN
            </a>
        </div>
    </div>

    <div x-show="kategori === 'menu'" class="space-y-4">
        <button @click="kategori = 'Proker'" class="group w-full bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-500/40 transition-all flex items-center justify-between overflow-hidden relative">
            <div class="flex items-center gap-6 relative z-10">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-calendar-check text-xl"></i>
                </div>
                <div class="text-left">
                    <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-[0.1em]">Program Kerja</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Kelola agenda, dokumentasi, dan rekap kegiatan</p>
                </div>
            </div>

            <div class="flex items-center gap-8 relative z-10">
                <div class="text-right hidden md:block">
                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest">Total Data</p>
                    <p class="text-xs font-black text-emerald-600">{{ $konten->where('kategori', 'Proker')->count() }} Konten Terbit</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-all">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </div>
            </div>
            <div class="absolute right-0 top-0 h-full w-32 bg-gradient-to-l from-emerald-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </button>

        <button @click="kategori = 'Prestasi'" class="group w-full bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-amber-500/40 transition-all flex items-center justify-between overflow-hidden relative">
            <div class="flex items-center gap-6 relative z-10">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-trophy text-xl"></i>
                </div>
                <div class="text-left">
                    <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-[0.1em]">Prestasi</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Kelola arsip pencapaian dan kompetisi anggota</p>
                </div>
            </div>

            <div class="flex items-center gap-8 relative z-10">
                <div class="text-right hidden md:block">
                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest">Total Data</p>
                    <p class="text-xs font-black text-amber-600">{{ $konten->where('kategori', 'Prestasi')->count() }} Konten Terbit</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 group-hover:bg-amber-50 group-hover:text-amber-600 transition-all">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </div>
            </div>
            <div class="absolute right-0 top-0 h-full w-32 bg-gradient-to-l from-amber-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </button>
    </div>

    <div x-show="kategori !== 'menu'" x-cloak x-transition class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-4 text-center w-16">No</th>
                        <th class="px-6 py-4">Thumbnail</th>
                        <th class="px-6 py-4">Judul Konten</th>
                        <th class="px-6 py-4 text-center">Tanggal Terbit</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    @php $noProker = 1; $noPrestasi = 1; @endphp
                    @foreach ($konten as $item)
                        <tr x-show="kategori === '{{ $item->kategori }}'" class="hover:bg-gray-50/30 transition-colors group">
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                {{ $item->kategori == 'Proker' ? $noProker++ : $noPrestasi++ }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-12 h-8 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name=No+Image&background=0a362d&color=fff" class="w-full h-full object-cover">
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block max-w-[300px] truncate uppercase tracking-tight">{{ $item->judul }}</span>
                                <span class="block text-[9px] text-gray-400 font-medium italic mt-0.5 uppercase">{{ $item->sub_judul ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                {{ $item->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('admin.konten.edit', $item->id) }}" class="text-gray-300 hover:text-blue-600 transition-colors text-[10px] uppercase font-black">Edit</a>
                                    <form action="{{ route('admin.konten.destroy', $item->id) }}" method="POST" onsubmit="return confirm('YAKIN HAPUS?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-600 transition-colors text-[10px] uppercase font-black">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
