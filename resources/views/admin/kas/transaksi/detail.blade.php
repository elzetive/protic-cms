@extends('admin.layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto animate-in fade-in duration-500 overflow-hidden">
    <form action="{{ route('admin.kas.update', $kas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Edit Transaksi Kas</h2>
                <span class="bg-amber-50 text-amber-600 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border border-amber-100">
                    ID Transaksi: #{{ $kas->id }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-5">
                <div class="md:col-span-1 space-y-3">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-center">Bukti Transaksi</label>
                    <div class="relative group w-full aspect-[3/4] rounded-2xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center">
                        <img id="previewBukti"
                             src="{{ $kas->bukti ? asset('storage/' . $kas->bukti) : 'https://placehold.co/400x600/0a362d/ffffff?text=NO+IMAGE' }}"
                             class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-cloud-arrow-up text-white text-xl"></i>
                        </div>
                        <input type="file" name="bukti" onchange="previewImage(event)" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    <p class="text-[8px] text-gray-400 text-center italic font-medium uppercase leading-none mt-2">Ketuk untuk ganti bukti (Maks 2MB)</p>
                </div>

                <div class="md:col-span-2 grid grid-cols-2 gap-x-4 gap-y-4">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-left ml-1">Kategori Transaksi</label>
                        <select name="kategori" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 appearance-none cursor-pointer text-[#0a362d] uppercase">
                            @php
                                $options = $kas->tipe == 'Masuk'
                                    ? ['DANA USAHA (DANUS)', 'SPONSOR', 'DANA HIBAH KAMPUS', 'PEMASUKAN LAIN-LAIN', 'IURAN']
                                    : ['KONSUMSI RAPAT', 'ATK & CETAK', 'SEWA TEMPAT/ALAT', 'HOSTING & DOMAIN', 'BIAYA TRANSPORTASI', 'KEBUTUHAN PROKER', 'PENGELUARAN LAIN-LAIN'];
                            @endphp
                            @foreach($options as $opt)
                                <option value="{{ $opt }}" {{ $kas->kategori == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-left ml-1">Periode</label>
                        <input type="text" name="periode" value="{{ old('periode', $kas->periode) }}" required
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-left ml-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $kas->tanggal) }}" required
                               class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-left ml-1">Nominal (IDR)</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-[9px] text-gray-400 font-black">RP</span>
                            <input type="number" name="nominal" value="{{ old('nominal', $kas->nominal) }}" required
                                   class="w-full bg-gray-50 border-none py-4 pl-14 pr-6 rounded-2xl text-lg font-black focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-left ml-1">Keterangan</label>
                        <textarea name="keterangan" rows="3" required
                                  class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase resize-none">{{ old('keterangan', $kas->keterangan) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex gap-3 border-t border-gray-50 pt-6">
                <button type="submit" class="bg-[#0a362d] text-white px-10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-[#0a362d]/10 active:scale-95">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.kas.index') }}" class="bg-gray-100 text-gray-400 px-10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all text-center flex items-center justify-center">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('previewBukti').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
