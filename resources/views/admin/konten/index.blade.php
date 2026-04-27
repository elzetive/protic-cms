@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-700">

    {{-- ALERT NOTIFIKASI --}}
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

    {{-- HEADER HALAMAN --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Manajemen Konten</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Kelola Proker & Prestasi PROTIC</p>
        </div>
        <a href="{{ route('admin.konten.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95">
            <i class="fa-solid fa-plus text-[10px]"></i> TAMBAH KONTEN
        </a>
    </div>

    {{-- TABEL DATA --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5 text-center w-16">No</th>
                        <th class="px-6 py-5">Thumbnail</th>
                        <th class="px-6 py-5">Judul Konten</th>
                        <th class="px-6 py-5">Kategori</th>
                        <th class="px-6 py-5 text-center">Tanggal</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    @forelse ($konten as $index => $item)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-3.5 text-center text-gray-400 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-3.5">
                            <div class="w-16 h-10 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 shadow-sm transition-transform group-hover:scale-105">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover" alt="Thumbnail">
                                @else
                                    <img src="https://ui-avatars.com/api/?name=No+Image&background=0a362d&color=fff" class="w-full h-full object-cover" alt="No Thumbnail">
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-3.5">
                            <span class="block max-w-[300px] truncate uppercase tracking-tight">{{ $item->judul }}</span>
                        </td>
                        <td class="px-6 py-3.5">
                            @if($item->kategori == 'Proker')
                                <span class="text-emerald-600 uppercase text-[9px] tracking-widest bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg font-black">PROKER</span>
                            @else
                                <span class="text-amber-600 uppercase text-[9px] tracking-widest bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-lg font-black">PRESTASI</span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-center text-gray-400 font-medium">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-8 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-4">
                                {{-- Link Edit --}}
                                <a href="{{ route('admin.konten.edit', $item->id) }}" class="text-gray-300 hover:text-blue-600 transition-colors text-[10px] uppercase tracking-tighter font-bold">Edit</a>

                                {{-- FORM HAPUS --}}
                                <form action="{{ route('admin.konten.destroy', $item->id) }}" method="POST" onsubmit="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS KONTEN INI?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-300 hover:text-red-600 transition-colors text-[10px] uppercase tracking-tighter font-bold">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-gray-400 italic uppercase tracking-widest text-[10px]">
                            Belum ada data konten yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER / PAGINATION --}}
        <div class="p-6 bg-white border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em]">
                Total Konten: {{ $konten->count() }} Item
            </p>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 text-[10px] font-black text-gray-300 uppercase tracking-widest hover:text-[#0a362d] transition-all disabled:opacity-50" disabled>
                    <i class="fa-solid fa-chevron-left mr-1"></i> Kembali
                </button>
                <div class="flex items-center gap-2">
                    <button class="w-7 h-7 flex items-center justify-center rounded-xl bg-[#0a362d] text-white text-[10px] font-black shadow-lg shadow-[#0a362d]/20">1</button>
                </div>
                <button class="px-4 py-2 text-[10px] font-black text-gray-300 uppercase tracking-widest disabled:opacity-50" disabled>
                    Lanjut <i class="fa-solid fa-chevron-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
