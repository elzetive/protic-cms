@extends('admin.layouts.admin')

@section('content')
<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden">

    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between shrink-0">
        <div>
            <h3 class="text-lg font-black text-[#0a362d] uppercase tracking-widest leading-none">Manajemen Transaksi</h3>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 italic">Pantau Arus Keuangan PROTIC (Buku Besar)</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-amber-600 transition-all shadow-md active:scale-95">
            <i class="fa-solid fa-plus text-[8px]"></i> Transaksi Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 shrink-0">
        @foreach([
            ['label' => 'Total Pemasukan', 'val' => $totalMasuk, 'color' => 'text-emerald-600', 'bg' => 'text-emerald-50/50', 'icon' => 'fa-arrow-trend-up'],
            ['label' => 'Total Pengeluaran', 'val' => $totalKeluar, 'color' => 'text-rose-600', 'bg' => 'text-rose-50/50', 'icon' => 'fa-arrow-trend-down'],
            ['label' => 'Saldo Akhir', 'val' => $saldoSisa, 'color' => 'text-amber-500', 'bg' => 'text-amber-50/50', 'icon' => 'fa-sack-dollar']
        ] as $stat)
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10 text-left">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ $stat['label'] }}</p>
                <h4 class="text-xl font-black {{ $stat['color'] }}">
                    <span class="text-xs opacity-40">Rp</span> {{ number_format($stat['val'], 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid {{ $stat['icon'] }} absolute -right-2 -bottom-2 text-5xl {{ $stat['bg'] }} transition-transform group-hover:scale-110"></i>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col flex-1 min-h-0">
        <div class="px-6 py-3.5 border-b border-gray-50 flex justify-between items-center bg-gray-50/20 shrink-0">
            <h4 class="font-black text-[#0a362d] uppercase text-[9px] tracking-[0.2em]">Riwayat Kas Masuk & Keluar</h4>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100 sticky top-0 z-10">
                        <th class="px-8 py-4">Kategori & Keterangan</th>
                        <th class="px-6 py-4 text-center">Tipe</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d] divide-y divide-gray-50 uppercase">
                    @forelse ($transaksi as $item)
                    <tr class="hover:bg-gray-50/30 transition-all group">
                        <td class="px-8 py-3">
                            <div class="flex flex-col text-left">
                                <span class="tracking-tight font-black">{{ $item->kategori }}</span>
                                <span class="text-[8px] text-gray-400 font-bold tracking-tighter">{{ $item->keterangan }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-center">
                            <span class="px-3 py-1 rounded-lg text-[7px] font-black {{ $item->tipe == 'Masuk' ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }}">
                                {{ $item->tipe }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-right font-black text-xs {{ $item->tipe == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $item->tipe == 'Masuk' ? '+' : '-' }} {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-3 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.kas.show', $item->id) }}" class="text-gray-300 hover:text-amber-500 transition-all">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </a>
                                <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-200 hover:text-rose-600 transition-all">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-300 uppercase text-[9px] tracking-widest italic font-bold">
                            Belum ada catatan keuangan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-xl p-8 shadow-2xl animate-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-6 px-1">
            <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Transaksi Baru</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form action="{{ route('admin.kas.store') }}" method="POST" class="space-y-5 text-left uppercase">
            @csrf
            <input type="hidden" name="periode" value="{{ date('Y') }}">

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1 space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe Arus</label>
                    <select name="tipe" id="tipeSelect" onchange="updateKategori()" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d] appearance-none cursor-pointer">
                        <option value="Masuk">MASUK (+)</option>
                        <option value="Keluar" selected>KELUAR (-)</option>
                    </select>
                </div>

                <div class="col-span-1 space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d]">
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori Program</label>
                    <select name="kategori" id="kategoriSelect" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d] appearance-none cursor-pointer">
                    </select>
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Nominal (IDR)</label>
                    <input type="number" name="nominal" required placeholder="0" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d]">
                </div>

                <div class="col-span-2 space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Keterangan / Catatan</label>
                    <textarea name="keterangan" rows="2" placeholder="CATATAN SINGKAT..." class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d] uppercase resize-none"></textarea>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#0a362d] text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg active:scale-95 hover:bg-amber-600 transition-all mt-2">
                Simpan Transaksi
            </button>
        </form>
    </div>
</div>

<script>
    const kategoriOptions = {
        'Masuk': ['Dana Usaha (Danus)', 'Sponsor', 'Dana Hibah Kampus', 'Pemasukan Lain-lain'],
        'Keluar': ['Konsumsi Rapat', 'ATK & Cetak', 'Sewa Tempat/Alat', 'Hosting & Domain', 'Biaya Transportasi', 'Kebutuhan Proker', 'Pengeluaran Lain-lain']
    };

    function updateKategori() {
        const tipe = document.getElementById('tipeSelect').value;
        const kategoriSelect = document.getElementById('kategoriSelect');
        kategoriSelect.innerHTML = '';
        kategoriOptions[tipe].forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.toUpperCase();
            option.text = opt.toUpperCase();
            kategoriSelect.appendChild(option);
        });
    }
    window.onload = updateKategori;
</script>
@endsection
