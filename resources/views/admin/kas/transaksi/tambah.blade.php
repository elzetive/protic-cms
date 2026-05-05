@extends('admin.layouts.admin')

@section('content')
<form action="#" method="POST" class="space-y-4 animate-in fade-in duration-500">
    @csrf
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.kas.index') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-[#0a362d] hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Tambah Transaksi</h1>
        </div>
        <button type="submit" class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 shadow-lg shadow-[#0a362d]/20 active:scale-95 transition-all">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Transaksi
        </button>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm space-y-6">
        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Detail Keuangan</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Keterangan</label>
                <input type="text" name="keterangan" placeholder="Contoh: Pembelian domain" class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
            </div>

            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Jenis Kas</label>
                <select name="tipe" class="w-full bg-gray-50 border border-gray-100 py-3 px-5 rounded-xl text-[11px] font-bold focus:outline-none focus:border-amber-500 transition-all cursor-pointer">
                    <option value="masuk">UANG MASUK (PEMASUKAN)</option>
                    <option value="keluar">UANG KELUAR (PENGELUARAN)</option>
                </select>
            </div>
            <div>
                <label class="block text-[11px] font-black text-[#0a362d] uppercase tracking-widest mb-2 ml-1">Nominal (Rp)</label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[10px] text-gray-400 font-black">RP</span>
                    <input type="number" name="nominal" placeholder="0" class="w-full bg-gray-50 border border-gray-100 py-3 pl-12 pr-5 rounded-xl text-xs font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-gray-300">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
