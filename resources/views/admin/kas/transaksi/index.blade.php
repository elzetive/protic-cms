@extends('admin.layouts.admin')

@section('content')
<div class="space-y-4 animate-in fade-in duration-500">

    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Manajemen Transaksi Kas</h3>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 italic">Catat arus kas masuk & keluar</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-[#082a23] transition-all shadow-lg active:scale-95">
            <i class="fa-solid fa-plus text-[8px]"></i> Transaksi Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pemasukan</p>
                <h4 class="text-xl font-black text-emerald-600">
                    <span class="text-[10px] opacity-40">Rp</span> {{ number_format($totalMasuk, 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid fa-arrow-trend-up absolute -right-2 -bottom-2 text-5xl text-emerald-50/50 transition-transform group-hover:scale-110"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                <h4 class="text-xl font-black text-rose-600">
                    <span class="text-[10px] opacity-40">Rp</span> {{ number_format($totalKeluar, 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid fa-arrow-trend-down absolute -right-2 -bottom-2 text-5xl text-rose-50/50 transition-transform group-hover:scale-110"></i>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Saldo Akhir</p>
                <h4 class="text-xl font-black text-amber-500">
                    <span class="text-[10px] opacity-40 text-gray-400">Rp</span> {{ number_format($saldoSisa, 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid fa-sack-dollar absolute -right-2 -bottom-2 text-5xl text-gray-50 transition-transform group-hover:scale-110"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Riwayat Transaksi</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-4">Kategori & Keterangan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @forelse ($transaksi as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="uppercase">{{ $item->kategori }}</span>
                                <span class="text-[8px] text-gray-400 uppercase font-medium tracking-tighter italic lowercase">{{ $item->keterangan }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 uppercase font-medium">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->tipe == 'Masuk')
                                <span class="text-[8px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">Masuk</span>
                            @else
                                <span class="text-[8px] font-black uppercase tracking-widest text-rose-600 bg-rose-50 px-2 py-0.5 rounded">Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right font-black {{ $item->tipe == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $item->tipe == 'Masuk' ? '+' : '-' }} {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-600 transition-all">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-300 uppercase text-[9px] tracking-widest italic">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl animate-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xs font-black text-[#0a362d] uppercase tracking-widest">Transaksi Baru</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe</label>
                    <select name="tipe" required class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all uppercase">
                        <option value="Masuk">Masuk (+)</option>
                        <option value="Keluar">Keluar (-)</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                <input type="text" name="kategori" required placeholder="Contoh: Iuran, Konsumsi" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all uppercase">
            </div>

            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Nominal (Rp)</label>
                <input type="number" name="nominal" required placeholder="0" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-black focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
            </div>

            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Keterangan</label>
                <textarea name="keterangan" rows="2" class="w-full bg-gray-50 border border-gray-100 py-2.5 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all resize-none uppercase" placeholder="Keterangan singkat..."></textarea>
            </div>

            <button type="submit" class="w-full bg-[#0a362d] text-white py-3 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] shadow-lg hover:bg-[#082a23] transition-all mt-2 active:scale-95">
                Simpan Transaksi
            </button>
        </form>
    </div>
</div>
@endsection
