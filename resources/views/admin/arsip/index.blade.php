@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Arsip Dokumen</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Pusat penyimpanan dokumen & laporan UKM PROTIC</p>
        </div>
        <a href="{{ route('admin.arsip.tambah') }}"
            class="bg-[#0a362d] text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center justify-center gap-3 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95 border-b-4 border-[#061d18]">
            <i class="fa-solid fa-cloud-arrow-up text-sm"></i> Tambah Arsip
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div>
                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Laporan & Proposal</p>
                <h4 class="text-lg font-black text-[#0a362d]">{{ $arsip->whereIn('kategori', ['LAPORAN', 'PROPOSAL'])->count() }}</h4>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-file-invoice"></i>
            </div>
            <div>
                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Surat Menyurat</p>
                <h4 class="text-lg font-black text-[#0a362d]">{{ $arsip->where('kategori', 'SURAT')->count() }}</h4>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Total Arsip</p>
                <h4 class="text-lg font-black text-[#0a362d]">{{ $arsip->count() }}</h4>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Daftar Dokumen Digital</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-5">Nama Dokumen</th>
                        <th class="px-8 py-5">Kategori</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @forelse ($arsip as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-all group">
                        <td class="px-8 py-5">
                            <span class="block uppercase font-black text-[#0a362d]">{{ $item->nama_dokumen }}</span>
                            <span class="text-[8px] text-gray-400 font-bold uppercase tracking-wider italic">
                                Diupload: {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-tighter">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            @if($item->status == 'PUBLIK')
                                <span class="text-emerald-600 flex items-center gap-1 uppercase tracking-widest text-[8px]">
                                    <i class="fa-solid fa-eye text-[10px]"></i> {{ $item->status }}
                                </span>
                            @else
                                <span class="text-amber-600 flex items-center gap-1 uppercase tracking-widest text-[8px]">
                                    <i class="fa-solid fa-lock text-[10px]"></i> {{ $item->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                    class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all flex items-center justify-center border border-emerald-100 shadow-sm">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </a>

                                <form action="#" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center border border-rose-100 shadow-sm">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-300 uppercase text-[9px] tracking-widest italic font-bold">
                            <i class="fa-solid fa-folder-open text-3xl mb-3 block opacity-20"></i>
                            Belum ada dokumen yang diarsip
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
