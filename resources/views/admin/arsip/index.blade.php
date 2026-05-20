@extends('admin.layouts.admin')

@section('content')
<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden">

    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">
        <div class="text-left">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Arsip Dokumen</h1>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 italic">
                @if(request('filter'))
                    <span class="text-amber-500">Filter Aktif: {{ request('filter') }}</span>
                @else
                    Pusat penyimpanan dokumen & laporan UKM PROTIC
                @endif
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if(request('filter'))
                <a href="{{ route('admin.arsip.index') }}" class="bg-rose-50 text-rose-600 px-4 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest flex items-center gap-2 border border-rose-100 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif

            <a href="{{ route('admin.surat.create') }}"
                class="bg-amber-500 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#0a362d] transition-all shadow-md active:scale-95">
                <i class="fa-solid fa-file-pen"></i> Buat Surat
            </a>

            <a href="{{ route('admin.arsip.tambah') }}"
                class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-amber-600 transition-all shadow-md active:scale-95">
                <i class="fa-solid fa-cloud-arrow-up"></i> Tambah Arsip
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 shrink-0">
        <a href="{{ route('admin.arsip.index', ['filter' => 'SURAT']) }}"
           class="bg-white p-5 rounded-3xl border {{ request('filter') == 'SURAT' ? 'border-blue-500 ring-4 ring-blue-50' : 'border-gray-100' }} shadow-sm flex items-center gap-5 transition-all hover:scale-[1.02] active:scale-95 group">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div class="text-left">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Surat Menyurat</p>
                <h4 class="text-xl font-black text-[#0a362d]">{{ $allArsip->where('kategori', 'SURAT')->count() }}</h4>
            </div>
        </a>

        <a href="{{ route('admin.arsip.index', ['filter' => 'NOTULENSI']) }}"
           class="bg-white p-5 rounded-3xl border {{ request('filter') == 'NOTULENSI' ? 'border-amber-500 ring-4 ring-amber-50' : 'border-gray-100' }} shadow-sm flex items-center gap-5 transition-all hover:scale-[1.02] active:scale-95 group text-left">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Notulensi Rapat</p>
                <h4 class="text-xl font-black text-[#0a362d]">{{ $allArsip->where('kategori', 'NOTULENSI')->count() }}</h4>
            </div>
        </a>

        <a href="{{ route('admin.arsip.index', ['filter' => 'LAINNYA']) }}"
           class="bg-white p-5 rounded-3xl border {{ request('filter') == 'LAINNYA' ? 'border-emerald-500 ring-4 ring-emerald-50' : 'border-gray-100' }} shadow-sm flex items-center gap-5 transition-all hover:scale-[1.02] active:scale-95 group text-left">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Dokumen Lainnya</p>
                <h4 class="text-xl font-black text-[#0a362d]">{{ $allArsip->where('kategori', 'LAINNYA')->count() }}</h4>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col flex-1 min-h-0">
        <div class="px-6 py-3.5 border-b border-gray-50 flex justify-between items-center bg-gray-50/20 shrink-0">
            <h4 class="font-black text-[#0a362d] uppercase text-[9px] tracking-[0.2em]">
                {{ request('filter') ? 'Hasil Filter Kategori' : 'Database Arsip Digital' }}
            </h4>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100 sticky top-0 z-10">
                        <th class="px-8 py-4">Informasi Dokumen</th>
                        <th class="px-8 py-4">Kategori</th>
                        <th class="px-8 py-4 text-center">Opsi Kelola</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d] divide-y divide-gray-50 uppercase">
                    @forelse ($arsip as $item)
                    <tr class="hover:bg-gray-50/30 transition-all group">
                        <td class="px-8 py-4 text-left">
                            <span class="block font-black tracking-tight text-[#0a362d]">{{ $item->nama_dokumen }}</span>
                            <span class="text-[7px] text-gray-400 font-black tracking-widest flex items-center gap-1 mt-0.5 uppercase">
                                <i class="fa-solid fa-calendar-check text-amber-500"></i> Diunggah {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-left">
                            <span class="bg-gray-100 text-[#0a362d] px-3 py-1 rounded-lg text-[8px] font-black tracking-widest border border-gray-200">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                    class="w-9 h-9 rounded-xl bg-white text-[#0a362d] hover:bg-emerald-600 hover:text-white transition-all flex items-center justify-center border border-gray-100 shadow-sm active:scale-90">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>

                                <form action="{{ route('admin.arsip.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-9 h-9 rounded-xl bg-white text-rose-400 hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center border border-gray-100 shadow-sm active:scale-90">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-20 text-center text-gray-300 uppercase text-[9px] tracking-widest italic font-bold">
                            <div class="flex flex-col items-center gap-3">
                                <i class="fa-solid fa-folder-open text-4xl opacity-20"></i>
                                <span>Belum ada dokumen yang tersedia</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
