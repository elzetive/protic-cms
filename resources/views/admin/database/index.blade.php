@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">

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
        <div class="flex flex-col">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Database Pengurus</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Manajemen Anggota & Arsip Periode PROTIC</p>
        </div>
        <a href="{{ route('admin.database.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95">
            <i class="fa-solid fa-user-plus text-[10px]"></i> TAMBAH PENGURUS
        </a>
    </div>

    {{-- TABEL DATA --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5 text-center w-16">No</th>
                        <th class="px-6 py-5">Foto</th>
                        <th class="px-6 py-5">Identitas</th>
                        <th class="px-6 py-5">Divisi / Jabatan</th>
                        <th class="px-6 py-5 text-center">Periode</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                    @forelse ($pengurus as $index => $item)
                    <tr class="hover:bg-gray-50/30 transition-colors group">
                        <td class="px-8 py-4 text-center text-gray-300 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 border-2 border-white shadow-md transition-transform group-hover:scale-110">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover" alt="Foto">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=0a362d&color=fff" class="w-full h-full object-cover" alt="Avatar">
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="uppercase tracking-tight text-[12px]">{{ $item->nama }}</span>
                                <span class="text-gray-400 font-medium text-[9px] mt-0.5 tracking-widest">NIM: {{ $item->nim }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-amber-600 uppercase text-[10px] font-black tracking-widest">{{ $item->jabatan }}</span>
                                <span class="text-gray-400 font-medium text-[9px] uppercase tracking-tighter">{{ $item->divisi ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-amber-50 text-amber-700 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase border border-amber-100">
                                {{ $item->angkatan }}/{{ $item->angkatan + 1 }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:text-[#0a362d] hover:bg-green-50 transition-all">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                {{-- Pastikan Route Destroy sudah ada di web.php --}}
                                <form action="{{ route('admin.database.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data pengurus periode ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-300 hover:text-red-600 hover:bg-red-50 transition-all">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-users-slash text-gray-100 text-6xl mb-4"></i>
                                <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-[10px]">Belum ada data pengurus di periode ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER STATS --}}
        <div class="p-6 bg-white border-t border-gray-50">
            <p class="text-[10px] text-gray-300 font-black uppercase tracking-[0.2em]">
                Total Record Database: {{ $pengurus->count() }} Entri
            </p>
        </div>
    </div>
</div>
@endsection
