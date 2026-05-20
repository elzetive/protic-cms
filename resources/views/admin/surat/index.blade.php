@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 pb-10 animate-in fade-in duration-500">

    @if (session('success'))
        <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl no-print">
            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Berhasil:</p>
            <p class="text-[10px] text-emerald-500 font-bold uppercase tracking-tight mt-0.5">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex items-center justify-between px-2">
        <div class="flex flex-col text-left">
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Arsip Surat Resmi</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Daftar generator surat dinamis UKM PROTIC yang tersimpan di database</p>
        </div>
        <div>
            <a href="{{ route('admin.surat.create') }}" class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20">
                <i class="fa-solid fa-plus"></i> Buat Surat Baru
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse uppercase">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-[10px] font-black text-[#0a362d] tracking-widest">
                        <th class="p-4 text-center w-16">No</th>
                        <th class="p-4">Nomor Surat</th>
                        <th class="p-4">Perihal / Hal</th>
                        <th class="p-4">Tanggal Pelaksanaan</th>
                        <th class="p-4 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarSurat as $key => $surat)
                        <tr class="border-b border-gray-100 text-xs font-bold text-gray-700 tracking-tight hover:bg-gray-50/50 transition-all">
                            <td class="p-4 text-center text-gray-400">{{ $key + 1 }}</td>
                            <td class="p-4 text-[#0a362d] font-black">{{ $surat->nomor_surat }}</td>
                            <td class="p-4 normal-case text-gray-600 font-medium">{{ $surat->hal }}</td>
                            <td class="p-4 text-gray-500">{{ $surat->tanggal_kegiatan }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.surat.cetak', $surat->id) }}" target="_blank"
                                   class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 px-4 py-2 rounded-xl text-[10px] font-black tracking-widest hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                                    <i class="fa-solid fa-print"></i> Cetak Ulang
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-solid fa-folder-open text-4xl text-gray-200"></i>
                                    <span>Belum ada data surat dinamis yang tersimpan di database</span>
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
