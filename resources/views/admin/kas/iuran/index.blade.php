@extends('admin.layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<div class="space-y-4 animate-in fade-in duration-500">

    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Manajemen Iuran Anggota</h3>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 italic">Rekapitulasi iuran bulanan pengurus</p>
        </div>
        <button onclick="document.getElementById('modalTambahIuran').classList.remove('hidden')"
            class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg active:scale-95">
            <i class="fa-solid fa-plus text-[8px]"></i> Catat Iuran
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Riwayat Pembayaran Iuran</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-4">Nama Pengurus</th>
                        <th class="px-6 py-4">Bulan / Periode</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @forelse ($iuran as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                        <td class="px-6 py-4 uppercase font-black">{{ $item->keterangan }}</td>
                        <td class="px-6 py-4 text-gray-400 uppercase font-medium">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[8px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Lunas</span>
                        </td>
                        <td class="px-6 py-4 text-right font-black text-emerald-600">
                            + {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data iuran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-600 transition-all">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-300 uppercase text-[9px] tracking-widest italic">Belum ada data iuran masuk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambahIuran" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl animate-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xs font-black text-[#0a362d] uppercase tracking-widest">Catat Iuran Anggota</h3>
            <button onclick="document.getElementById('modalTambahIuran').classList.add('hidden')" class="text-gray-400 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kas.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="kategori" value="Iuran">
            <input type="hidden" name="tipe" value="Masuk">

            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Cari Pengurus</label>
                <div class="relative">
                    <select name="keterangan" id="select-pengurus" required placeholder="KETIK NAMA PENGURUS...">
                        <option value=""></option>
                        @foreach($daftarPengurus as $p)
                            <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="text-[7px] text-gray-400 ml-2 italic">*Pilih nama sesuai database pengurus</p>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Nominal (Rp)</label>
                    <input type="number" name="nominal" required value="10000" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-black focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Bayar</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#0a362d] text-white py-3 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] shadow-lg hover:bg-[#082a23] transition-all mt-2 active:scale-95">
                Simpan Iuran
            </button>
        </form>
    </div>
</div>

<style>
    .ts-control {
        border: 1px solid #f3f4f6 !important;
        background-color: #f9fafb !important;
        border-radius: 0.75rem !important;
        padding: 0.625rem 1rem !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        color: #0a362d !important;
        box-shadow: none !important;
    }
    .ts-dropdown {
        border-radius: 0.75rem !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        color: #0a362d !important;
        border: 1px solid #f3f4f6 !important;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1) !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#select-pengurus", {
            create: false,
            sortField: { field: "text", direction: "asc" }
        });
    });
</script>
@endsection
