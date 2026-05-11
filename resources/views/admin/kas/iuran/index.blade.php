@extends('admin.layouts.admin')

@section('content')
<style>
    [x-cloak] { display: none !important; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden"
     x-data="{
        view: localStorage.getItem('PROTIC_VIEW') || 'periode',
        selectedPeriode: localStorage.getItem('PROTIC_PERIODE') || '{{ date('Y') }}',
        selectedBulan: localStorage.getItem('PROTIC_BULAN') || '{{ date('F') }}',
        showModal: false,
        searchQuery: '',
        statusFilter: 'semua',
        allIuran: {{ $iuran->toJson() }},
        listPengurus: {{ $daftarPengurus->toJson() }},

        modalPeriode: '',
        tsInstance: null,

        saveState() {
            localStorage.setItem('PROTIC_VIEW', this.view);
            localStorage.setItem('PROTIC_PERIODE', this.selectedPeriode);
            localStorage.setItem('PROTIC_BULAN', this.selectedBulan);
        },

        checkLunas(nama, bulan = null, periode = null) {
            let targetBulan = bulan || this.selectedBulan;
            let targetPeriode = periode || this.selectedPeriode;
            return this.allIuran.find(i =>
                i.keterangan.toLowerCase() === nama.toLowerCase() &&
                i.kategori.toLowerCase() === targetBulan.toLowerCase() &&
                i.periode == targetPeriode
            );
        },

        updateModalOptions() {
            if(!this.tsInstance) return;
            this.tsInstance.clear();
            this.tsInstance.clearOptions();
            if(this.modalPeriode === '') return;

            let filtered = this.getSortedPengurus(this.modalPeriode);
            filtered.forEach(p => {
                this.tsInstance.addOption({ value: p.nama, text: p.nama.toUpperCase() });
            });
            this.tsInstance.refreshOptions();
        },

        getSortedPengurus(periode) {
            const jobWeight = { 'KETUA': 1, 'WAKIL KETUA': 2, 'SEKRETARIS': 3, 'BENDAHARA': 4, 'KEPALA DIVISI': 5, 'ANGGOTA': 6 };
            const divWeight = {
                'BADAN PENGURUS HARIAN': 1,
                'DIVISI KOMINFO': 2, 'DIVISI HUMAS': 3, 'DIVISI WEB': 4,
                'DIVISI UI/UX': 5, 'DIVISI MOBILE': 6, 'DIVISI DATA': 7, 'DIVISI DEVOPS': 8
            };

            return this.listPengurus
                .filter(p => p.angkatan == periode)
                .sort((a, b) => {
                    if (jobWeight[a.jabatan] !== jobWeight[b.jabatan]) {
                        return jobWeight[a.jabatan] - jobWeight[b.jabatan];
                    }
                    return (divWeight[a.divisi] || 99) - (divWeight[b.divisi] || 99);
                });
        },

        get stats() {
            let totalLunas = 0; let totalBelum = 0; const nominalIuran = 10000;
            let filtered = this.listPengurus.filter(p => p.angkatan == this.selectedPeriode);
            if (this.view === 'bulan') {
                let daftarBulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
                filtered.forEach(p => {
                    daftarBulan.forEach(b => {
                        let data = this.checkLunas(p.nama, b, this.selectedPeriode);
                        if (data) totalLunas += parseInt(data.nominal); else totalBelum += nominalIuran;
                    });
                });
            } else if (this.view === 'list') {
                filtered.forEach(p => {
                    let data = this.checkLunas(p.nama);
                    if (data) totalLunas += parseInt(data.nominal); else totalBelum += nominalIuran;
                });
            }
            return { lunas: totalLunas.toLocaleString('id-ID'), belum: totalBelum.toLocaleString('id-ID') };
        }
     }"
     x-init="$watch('showModal', v => {
        if(v && !tsInstance) {
            tsInstance = new TomSelect('#select-pengurus-modal', {
                create: false,
                placeholder: 'CARI NAMA...',
                sortField: { field: 'text', direction: 'asc' }
            });
        }
     })">

    <div class="flex items-center justify-between shrink-0 bg-white p-5 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <h3 class="text-lg font-black text-[#0a362d] uppercase tracking-widest leading-none">Financial Tracker</h3>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 italic">
                <span x-show="view === 'periode'">Pilih Periode Kepengurusan</span>
                <span x-show="view === 'bulan'" x-cloak>Periode <span x-text="selectedPeriode + ' / ' + (parseInt(selectedPeriode) + 1)"></span></span>
                <span x-show="view === 'list'" x-cloak x-text="'Iuran ' + selectedBulan"></span>
            </p>
        </div>
        <div class="flex gap-3">
            <button type="button" x-show="view !== 'periode'" @click="view = (view === 'list' ? 'bulan' : 'periode'); saveState();" x-cloak
                    class="bg-white border border-gray-100 text-[#0a362d] px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </button>
            <button @click="showModal = true" class="bg-[#0a362d] text-white px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-md active:scale-95 transition-all">
                <i class="fa-solid fa-plus mr-1"></i> Catat Iuran
            </button>
        </div>
    </div>

    <div x-show="view !== 'periode'" x-cloak x-transition class="grid grid-cols-2 gap-4 shrink-0">
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between px-10 relative overflow-hidden group">
            <div class="relative z-10 flex flex-col text-left">
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Terkumpul</span>
                <h4 class="text-xl font-black text-emerald-600">Rp <span x-text="stats.lunas"></span></h4>
            </div>
            <i class="fa-solid fa-sack-dollar text-3xl text-emerald-50 transition-transform group-hover:scale-110"></i>
        </div>
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between px-10 relative overflow-hidden group">
            <div class="relative z-10 flex flex-col text-left">
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Tunggakan</span>
                <h4 class="text-xl font-black text-rose-500">Rp <span x-text="stats.belum"></span></h4>
            </div>
            <i class="fa-solid fa-hand-holding-dollar text-3xl text-rose-50 transition-transform group-hover:scale-110"></i>
        </div>
    </div>

    <div class="flex-1 min-h-0 overflow-hidden flex flex-col uppercase font-bold text-[#0a362d]">

        <div x-show="view === 'periode'" class="space-y-4 overflow-y-auto no-scrollbar pb-4">
            @php $periodes = $daftarPengurus->pluck('angkatan')->unique()->sortDesc(); @endphp
            @foreach ($periodes as $tahun)
                <button type="button" @click="view = 'bulan'; selectedPeriode = '{{ $tahun }}'; saveState();"
                    class="group w-full bg-white p-5 rounded-3xl border border-gray-100 flex items-center justify-between hover:border-[#0a362d] transition-all shadow-sm">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-gray-50 text-[#0a362d] rounded-2xl flex items-center justify-center group-hover:bg-[#0a362d] group-hover:text-white text-xl transition-all"><i class="fa-solid fa-folder-tree"></i></div>
                        <span class="text-sm">PERIODE {{ $tahun }} / {{ $tahun + 1 }}</span>
                    </div>
                    <div class="flex items-center gap-4 text-gray-300 group-hover:text-[#0a362d]">
                        <span class="text-[9px] font-black italic tracking-widest">BUKA PERIODE</span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </div>
                </button>
            @endforeach
        </div>

        <div x-show="view === 'bulan'" x-cloak x-transition class="grid grid-cols-2 md:grid-cols-4 gap-4 pb-4">
            @foreach(['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'] as $bulan)
            <button @click="selectedBulan = '{{ $bulan }}'; view = 'list'; saveState();"
                class="group bg-white py-6 rounded-3xl border border-gray-50 hover:bg-[#0a362d] hover:text-white transition-all flex flex-col items-center gap-3 shadow-sm active:scale-95">
                <i class="fa-solid fa-calendar-check text-lg text-[#0a362d] group-hover:text-white transition-colors"></i>
                <span class="text-[10px] font-black uppercase text-[#0a362d] group-hover:text-white tracking-widest">{{ $bulan }}</span>
            </button>
            @endforeach
        </div>

        <div x-show="view === 'list'" x-cloak class="bg-white rounded-3xl border border-gray-100 shadow-sm flex flex-col flex-1 min-h-0 overflow-hidden">
            <div class="px-6 py-3.5 border-b border-gray-50 flex items-center justify-between bg-gray-50/20 shrink-0">
                <div class="flex bg-gray-100 p-1 rounded-xl">
                    <button @click="statusFilter = 'semua'" :class="statusFilter === 'semua' ? 'bg-[#0a362d] text-white shadow-sm' : 'text-gray-400'" class="px-5 py-1.5 rounded-lg text-[9px] font-black uppercase transition-all tracking-widest">Semua</button>
                    <button @click="statusFilter = 'lunas'" :class="statusFilter === 'lunas' ? 'bg-emerald-500 text-white shadow-sm' : 'text-gray-400'" class="px-5 py-1.5 rounded-lg text-[9px] font-black uppercase transition-all tracking-widest">Lunas</button>
                    <button @click="statusFilter = 'belum'" :class="statusFilter === 'belum' ? 'bg-rose-500 text-white shadow-sm' : 'text-gray-400'" class="px-5 py-1.5 rounded-lg text-[9px] font-black uppercase transition-all tracking-widest">Belum</button>
                </div>
                <input type="text" x-model="searchQuery" placeholder="CARI NAMA PENGURUS..." class="bg-white border border-gray-100 px-5 py-2 rounded-xl text-[10px] font-bold outline-none w-64 shadow-sm focus:ring-1 focus:ring-amber-500">
            </div>
            <div class="flex-1 overflow-y-auto no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <tbody class="text-[11px] font-bold divide-y divide-gray-50">
                        <template x-for="item in getSortedPengurus(selectedPeriode)" :key="item.nim">
                            <tr x-show="(searchQuery === '' || item.nama.toLowerCase().includes(searchQuery.toLowerCase())) && (statusFilter === 'semua' || (statusFilter === 'lunas' && checkLunas(item.nama)) || (statusFilter === 'belum' && !checkLunas(item.nama)))"
                                class="hover:bg-gray-50/50 transition-all">
                                <td class="px-10 py-4 text-left">
                                    <div class="flex items-center gap-4">
                                        <div class="w-1.5 h-6 rounded-full" :class="checkLunas(item.nama) ? 'bg-emerald-500' : 'bg-rose-500'"></div>
                                        <div class="flex flex-col">
                                            <a :href="'{{ url('admin/kas/iuran/show') }}/' + item.nama" class="hover:text-amber-500">
                                                <span x-text="item.nama"></span>
                                            </a>
                                            <span class="text-gray-400 text-[8px] font-black" x-text="item.jabatan + ' | ' + item.divisi"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-4 text-right">
                                    <span :class="checkLunas(item.nama) ? 'text-emerald-600' : 'text-rose-500 opacity-30'" class="font-black text-sm">
                                        Rp <span x-text="checkLunas(item.nama)?.nominal.toLocaleString('id-ID') || '0'"></span>
                                    </span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-[200] bg-[#0a362d]/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl animate-in zoom-in duration-300">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Catat Iuran</h3>
                <button @click="showModal = false; modalPeriode = ''; if(tsInstance) tsInstance.clear();" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-rose-500 transition-all"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form action="{{ route('admin.kas.store') }}" method="POST" class="space-y-5 uppercase text-left">
                @csrf
                <input type="hidden" name="tipe" value="Masuk">

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Periode</label>
                        <select name="periode" x-model="modalPeriode" @change="updateModalOptions()" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold text-[#0a362d] appearance-none cursor-pointer">
                            <option value="">PILIH</option>
                            @foreach ($periodes as $th) <option value="{{ $th }}">{{ $th }} / {{ $th + 1 }}</option> @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Bulan</label>
                        <select name="kategori" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold text-[#0a362d] appearance-none uppercase cursor-pointer">
                            <option value="">PILIH</option>
                            @foreach(['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'] as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Pengurus</label>
                    <select name="keterangan" id="select-pengurus-modal" required></select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Nominal</label>
                        <input type="number" name="nominal" required value="10000" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold text-[#0a362d]">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                        <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold text-[#0a362d]">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#0a362d] text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl active:scale-95 transition-all mt-2">Simpan Iuran</button>
            </form>
        </div>
    </div>
</div>
@endsection
