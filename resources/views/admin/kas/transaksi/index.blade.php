@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">

    <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <h3 class="text-lg font-black text-[#0a362d] uppercase tracking-widest leading-none">Manajemen Transaksi</h3>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2 italic">Pantau Arus Keuangan PROTIC (Buku Besar)</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-amber-600 transition-all shadow-lg active:scale-95">
            <i class="fa-solid fa-plus text-[8px]"></i> Transaksi Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['label' => 'Total Pemasukan', 'val' => $totalMasuk, 'color' => 'text-emerald-600', 'bg' => 'text-emerald-50/50', 'icon' => 'fa-arrow-trend-up'],
            ['label' => 'Total Pengeluaran', 'val' => $totalKeluar, 'color' => 'text-rose-600', 'bg' => 'text-rose-50/50', 'icon' => 'fa-arrow-trend-down'],
            ['label' => 'Saldo Akhir', 'val' => $saldoSisa, 'color' => 'text-amber-500', 'bg' => 'text-amber-50/50', 'icon' => 'fa-sack-dollar']
        ] as $stat)
        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ $stat['label'] }}</p>
                <h4 class="text-2xl font-black {{ $stat['color'] }}">
                    <span class="text-xs opacity-40">Rp</span> {{ number_format($stat['val'], 0, ',', '.') }}
                </h4>
            </div>
            <i class="fa-solid {{ $stat['icon'] }} absolute -right-2 -bottom-2 text-6xl {{ $stat['bg'] }} transition-transform group-hover:scale-110"></i>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-8 py-4">Kategori & Keterangan</th>
                        <th class="px-8 py-4 text-center">Tipe</th>
                        <th class="px-8 py-4 text-right">Nominal</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50 uppercase">
                    @forelse ($transaksi as $item)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-8 py-4">
                            <div class="flex flex-col">
                                <span class="tracking-tight">{{ $item->kategori }}</span>
                                <span class="text-[9px] text-gray-400 font-black tracking-tighter">{{ $item->keterangan }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black {{ $item->tipe == 'Masuk' ? 'text-emerald-600 bg-emerald-50' : 'text-rose-600 bg-rose-50' }}">
                                {{ $item->tipe }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-right font-black text-sm {{ $item->tipe == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $item->tipe == 'Masuk' ? '+' : '-' }} {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.kas.show', $item->id) }}" class="text-gray-300 hover:text-amber-500 transition-all active:scale-90">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>

                                <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-200 hover:text-rose-600 transition-all active:scale-90">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-16 text-center text-gray-300 uppercase text-[10px] tracking-widest italic">Belum ada catatan keuangan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambah" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-[3rem] w-full max-w-xl p-10 shadow-2xl animate-in zoom-in duration-300 border border-white/20">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Transaksi Baru</h3>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kas.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="periode" value="{{ date('Y') }}">

            <div class="grid grid-cols-2 gap-6">
                <div class="relative col-span-1">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Tipe</label>
                    <select name="tipe" id="tipeSelect" onchange="updateKategori()" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase appearance-none cursor-pointer">
                        <option value="Masuk">MASUK (+)</option>
                        <option value="Keluar" selected>KELUAR (-)</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                </div>

                <div class="relative col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                    <select name="kategori" id="kategoriSelect" required class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase appearance-none cursor-pointer">
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nominal (Rp)</label>
                    <input type="number" name="nominal" required placeholder="0" class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d]">
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="2" placeholder="CATATAN SINGKAT..." class="w-full bg-gray-50 border-none py-3 px-6 rounded-2xl text-xs font-bold focus:ring-2 focus:ring-amber-500 transition-all text-[#0a362d] uppercase resize-none"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-[#0a362d] text-white px-10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg active:scale-95">
                    Simpan Transaksi
                </button>
            </div>
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
