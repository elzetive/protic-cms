@extends('admin.layouts.admin')

@section('content')
<style> [x-cloak] { display: none !important; } </style>

<div class="space-y-6 animate-in fade-in duration-500"
     x-data="{
        view: '{{ session('open_periode') ? 'list' : 'periode' }}',
        selectedPeriode: '{{ session('open_periode') ? session('open_periode') . '/' . (session('open_periode') + 1) : '' }}',
        checkedCount: 0,
        showCloneModal: false,
        updateCheckedCount() {
            this.checkedCount = document.querySelectorAll('input[name=\'ids[]\']:checked').length;
        }
     }"
     @update-count.window="updateCheckedCount()">

    @if(session('success') || session('error'))
        <div id="alert-msg" class="fixed top-24 right-10 z-[100] transform transition-all duration-500">
            <div class="{{ session('success') ? 'bg-[#0a362d]' : 'bg-red-600' }} border-l-4 border-amber-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
                <div class="bg-white/20 p-2 rounded-lg">
                    <i class="fa-solid {{ session('success') ? 'fa-circle-check' : 'fa-circle-exclamation' }} text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-1">{{ session('success') ? 'BERHASIL!' : 'GAGAL!' }}</p>
                    <p class="text-[11px] font-medium italic opacity-90 uppercase tracking-wider">{{ session('success') ?? session('error') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="ml-4 opacity-50 hover:opacity-100">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('alert-msg');
                if(el) { el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
            }, 3000);
        </script>
    @endif

    <form method="POST" id="mainBulkForm">
        @csrf
        <div class="flex items-center justify-between mb-10">
            <div class="flex flex-col">
                <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Database Pengurus</h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                    <span x-show="view === 'periode'">Pilih Periode Kepengurusan PROTIC</span>
                    <span x-show="view === 'list'" x-cloak>Arsip Data: Periode <span x-text="selectedPeriode"></span></span>
                </p>
            </div>
            <div class="flex gap-3">
                <button type="button" x-show="view === 'list' && checkedCount > 0" x-cloak
                        @click="showCloneModal = true"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                    <i class="fa-solid fa-copy mr-2"></i> Clone Terpilih (<span x-text="checkedCount"></span>)
                </button>

                <button type="submit" x-show="view === 'list' && checkedCount > 0" x-cloak
                        onclick="this.form.action='{{ route('admin.database.bulkDestroy') }}'; return confirm('Hapus ' + checkedCount + ' data pengurus terpilih secara permanen?')"
                        class="bg-red-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 active:scale-95">
                    <i class="fa-solid fa-trash-can mr-2"></i> Hapus Terpilih (<span x-text="checkedCount"></span>)
                </button>

                <button type="button" x-show="view === 'list'" @click="view = 'periode'; checkedCount = 0" x-cloak class="bg-white border border-gray-200 text-[#0a362d] px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 active:scale-95 transition-all">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </button>
                <a href="{{ route('admin.database.tambah') }}" class="bg-[#0a362d] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#082a23] shadow-lg shadow-[#0a362d]/20 active:scale-95 transition-all">
                    <i class="fa-solid fa-user-plus text-[10px]"></i> TAMBAH PENGURUS
                </a>
            </div>
        </div>

        <div x-show="view === 'periode'" class="space-y-4">
            @php $periodes = $pengurus->pluck('angkatan')->unique()->sortDesc(); @endphp
            @forelse ($periodes as $thn)
                <button type="button" @click="view = 'list'; selectedPeriode = '{{ $thn }}/{{ $thn + 1 }}'"
                    class="group w-full bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:border-amber-500/40 transition-all flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-folder-open text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-[0.1em]">Periode {{ $thn }}/{{ $thn + 1 }}</h3>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Arsip Data Pengurus UKM PROTIC PNC</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-8">
                        <div class="text-right hidden md:block">
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest">Status Data</p>
                            <p class="text-xs font-black text-[#0a362d] uppercase">{{ $pengurus->where('angkatan', $thn)->count() }} Pengurus Terdaftar</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 group-hover:bg-amber-50 group-hover:text-amber-600 transition-all">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </div>
                    </div>
                </button>
            @empty
                <div class="text-center py-20 bg-white rounded-[2rem] border border-dashed border-gray-200">
                    <i class="fa-solid fa-database text-gray-100 text-6xl mb-4"></i>
                    <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-[10px]">Database Belum Terisi</p>
                </div>
            @endforelse
        </div>

        <div x-show="view === 'list'" x-cloak class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b">
                            <th class="px-6 py-5 text-center w-12">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                            </th>
                            <th class="px-8 py-5 text-center">No</th>
                            <th class="px-6 py-5">Profil</th>
                            <th class="px-6 py-5">Identitas</th>
                            <th class="px-6 py-5">Posisi</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[11px] font-bold text-[#0a362d] divide-y divide-gray-50">
                        @foreach ($periodes as $thn)
                            @php
                                $no = 1;
                                $jobPriority = [
                                    'KETUA' => 1, 'WAKIL KETUA' => 2, 'SEKRETARIS' => 3, 'BENDAHARA' => 4,
                                    'KEPALA DIVISI' => 5, 'ANGGOTA' => 6
                                ];

                                $divPriority = [
                                    'BADAN PENGURUS HARIAN' => 1, 'DIVISI KOMINFO' => 2, 'DIVISI HUMAS' => 3,
                                    'DIVISI WEB' => 4, 'DIVISI UI/UX' => 5, 'DIVISI MOBILE' => 6,
                                    'DIVISI DATA' => 7, 'DIVISI DEVOPS' => 8
                                ];

                                $sortedPengurus = $pengurus->where('angkatan', $thn)->sort(function($a, $b) use ($jobPriority, $divPriority) {
                                    $pA = $jobPriority[strtoupper($a->jabatan)] ?? 99;
                                    $pB = $jobPriority[strtoupper($b->jabatan)] ?? 99;
                                    if ($pA !== $pB) return $pA <=> $pB;

                                    $dA = $divPriority[strtoupper($a->divisi)] ?? 99;
                                    $dB = $divPriority[strtoupper($b->divisi)] ?? 99;
                                    if ($dA !== $dB) return $dA <=> $dB;

                                    $nimA = (int)substr($a->nim, 0, 2);
                                    $nimB = (int)substr($b->nim, 0, 2);
                                    if ($nimA !== $nimB) return $nimA <=> $nimB;

                                    return strcasecmp($a->nama, $b->nama);
                                });
                            @endphp
                            @foreach ($sortedPengurus as $item)
                                <tr x-show="selectedPeriode === '{{ $thn }}/{{ $thn + 1 }}'" class="hover:bg-gray-50/30 transition-colors">
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                               @change="$dispatch('update-count')"
                                               class="child-checkbox rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    </td>
                                    <td class="px-8 py-4 text-center text-gray-400">{{ $no++ }}</td>
                                    <td class="px-6 py-4">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=0a362d&color=fff" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex flex-col uppercase">
                                        <span class="tracking-tight">{{ $item->nama }}</span>
                                        <span class="text-gray-400 text-[9px] mt-0.5 tracking-widest">NIM: {{ $item->nim }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col uppercase">
                                            <span class="text-amber-600 text-[9px] font-black tracking-widest">{{ $item->jabatan }}</span>
                                            <span class="text-gray-400 text-[9px] mt-0.5">{{ $item->divisi ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.database.edit', $item->id) }}" class="w-7 h-7 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:text-[#0a362d] transition-all"><i class="fa-solid fa-pen-to-square text-xs"></i></a>
                                            <button type="button" @click="if(confirm('Hapus data pengurus?')) { $refs['deleteForm' + {{ $item->id }}].submit() }"
                                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-gray-50 text-gray-300 hover:text-red-600 transition-all">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="showCloneModal" x-cloak class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div @click.away="showCloneModal = false" class="bg-white rounded-3xl p-8 w-full max-md shadow-2xl animate-in zoom-in duration-300">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <i class="fa-solid fa-copy text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-[#0a362d] font-black uppercase tracking-widest text-sm">Clone Data</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Pilih Tahun Tujuan Duplikasi</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Tahun Angkatan Awal</label>
                        <input type="number" name="target_tahun" placeholder="Contoh: 2026"
                               onkeydown="if(event.keyCode === 13) { event.preventDefault(); return false; }"
                               class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-[#0a362d] focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <p class="text-[9px] text-gray-400 mt-2 italic font-medium leading-relaxed">
                            * Data pengurus akan diduplikasi ke periode <span class="text-blue-600 font-bold">Tahun/Tahun+1</span>. Jabatan akan otomatis di-reset menjadi 'ANGGOTA'.
                        </p>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="button" @click="showCloneModal = false"
                                class="flex-1 px-4 py-3 rounded-xl bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                            Batal
                        </button>
                        <button type="submit"
                                onclick="this.form.action='{{ route('admin.database.bulkClone') }}'"
                                class="flex-1 px-4 py-3 rounded-xl bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20 hover:bg-blue-700 active:scale-95 transition-all">
                            Mulai Clone
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @foreach ($pengurus as $item)
        <form x-ref="deleteForm{{ $item->id }}" action="{{ route('admin.database.destroy', $item->id) }}" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.child-checkbox');
                checkboxes.forEach(cb => {
                    if (cb.closest('tr').style.display !== 'none') {
                        cb.checked = this.checked;
                    }
                });
                window.dispatchEvent(new CustomEvent('update-count'));
            });
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('child-checkbox')) {
            window.dispatchEvent(new CustomEvent('update-count'));
        }
    });
</script>
@endsection
