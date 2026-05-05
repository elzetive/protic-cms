@extends('admin.layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest">Absensi Kegiatan</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">Kelola daftar hadir pengurus & anggota PROTIC</p>
        </div>
        <button onclick="document.getElementById('modalTambahKegiatan').classList.remove('hidden')"
            class="bg-[#0a362d] text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] flex items-center justify-center gap-3 hover:bg-[#082a23] transition-all shadow-lg shadow-[#0a362d]/20 active:scale-95 border-b-4 border-[#061d18]">
            <i class="fa-solid fa-plus-circle text-sm"></i> Buat Kegiatan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Kegiatan</p>
                <h4 class="text-xl font-black text-[#0a362d]">{{ $kegiatan->count() }}</h4>
            </div>
            <i class="fa-solid fa-calendar-check absolute -right-2 -bottom-2 text-5xl text-gray-50 transition-transform group-hover:scale-110"></i>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Sistem</p>
                <h4 class="text-xl font-black text-emerald-500 uppercase tracking-tighter text-sm">QR Code Active</h4>
            </div>
            <i class="fa-solid fa-qrcode absolute -right-2 -bottom-2 text-5xl text-gray-50 transition-transform group-hover:scale-110"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h4 class="font-black text-[#0a362d] uppercase text-[10px] tracking-[0.2em]">Daftar Riwayat Kegiatan</h4>
            <span class="text-[8px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full uppercase italic">Update: {{ date('H:i') }} WIB</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100">
                        <th class="px-6 py-4">Nama Kegiatan</th>
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4 text-center">Kehadiran</th>
                        <th class="px-6 py-4 text-center">QR Code</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d]">
                    @forelse ($kegiatan as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-all group">
                        <td class="px-6 py-4">
                            <span class="block uppercase font-black text-[#0a362d]">{{ $item->nama_kegiatan }}</span>
                            <span class="text-[8px] text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1 mt-0.5">
                                <i class="fa-solid fa-location-dot text-amber-500"></i> {{ $item->lokasi }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-400 uppercase font-medium">
                            <span class="block text-[10px]">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                            <span class="text-[8px] font-black text-[#0a362d]">Pukul {{ $item->waktu }} WIB</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-tighter">0 Hadir</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button onclick="showQR('{{ $item->token_absensi }}', '{{ $item->nama_kegiatan }}')"
                                class="w-8 h-8 rounded-lg bg-white text-[#0a362d] hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center mx-auto border border-gray-200 shadow-sm group-hover:scale-110">
                                <i class="fa-solid fa-qrcode text-sm"></i>
                            </button>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="#" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-600 transition-all p-2">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-300 uppercase text-[9px] tracking-widest italic font-bold">
                            <i class="fa-solid fa-folder-open text-3xl mb-3 block opacity-20"></i>
                            Belum ada kegiatan absensi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambahKegiatan" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] w-full max-w-md p-6 shadow-2xl animate-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-6 px-1">
            <h3 class="text-xs font-black text-[#0a362d] uppercase tracking-widest">Buat Absensi Baru</h3>
            <button onclick="document.getElementById('modalTambahKegiatan').classList.add('hidden')" class="text-gray-300 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-circle-xmark text-xl"></i>
            </button>
        </div>

        <form action="{{ route('admin.absensi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" required placeholder="CONTOH: RAPAT KOORDINASI" class="w-full bg-gray-50 border border-gray-100 py-3 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all uppercase">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-100 py-3 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Waktu</label>
                    <input type="time" name="waktu" required class="w-full bg-gray-50 border border-gray-100 py-3 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all">
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-[8px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi</label>
                <input type="text" name="lokasi" required oninput="this.value = this.value.toUpperCase()" placeholder="CONTOH: SEKRETARIAT UKM" class="w-full bg-gray-50 border border-gray-100 py-3 px-4 rounded-xl text-[10px] font-bold focus:ring-1 focus:ring-[#0a362d] outline-none transition-all uppercase">
            </div>

            <button type="submit" class="w-full bg-[#0a362d] text-white py-4 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg hover:bg-[#082a23] transition-all mt-2 active:scale-95 shadow-[#0a362d]/20 border-b-4 border-[#061d18]">
                Generate & Simpan QR
            </button>
        </form>
    </div>
</div>

<div id="modalShowQR" class="fixed inset-0 z-[110] hidden bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-sm p-8 text-center animate-in zoom-in duration-300 relative">
        <button onclick="document.getElementById('modalShowQR').classList.add('hidden')" class="absolute top-6 right-6 text-gray-400 hover:text-rose-500 transition-all">
            <i class="fa-solid fa-circle-xmark text-2xl"></i>
        </button>

        <h3 id="qrTitle" class="text-sm font-black text-[#0a362d] uppercase tracking-[0.1em] mb-2 px-6 truncate">QR ABSENSI</h3>
        <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-6 italic">Scan menggunakan perangkat anda</p>

        <div class="bg-gray-50 p-6 rounded-[2rem] border-4 border-dashed border-gray-100 flex items-center justify-center mb-6">
            <div id="qrContent" class="w-48 h-48 bg-white flex items-center justify-center rounded-2xl shadow-lg overflow-hidden border-4 border-white shadow-lg">
                <i class="fa-solid fa-qrcode text-6xl text-gray-100 animate-pulse"></i>
            </div>
        </div>

        <p class="text-[8px] font-black text-amber-500 uppercase tracking-[0.3em] mb-2">UKM PROTIC PNC SYSTEM</p>
        <div class="h-1 w-12 bg-amber-500 mx-auto rounded-full"></div>
    </div>
</div>

<script>
    function showQR(token, title) {
        document.getElementById('qrTitle').innerText = title;
        const qrContainer = document.getElementById('qrContent');
        qrContainer.innerHTML = `<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${window.location.origin}/absen/${token}" class="w-full h-full object-cover">`;
        document.getElementById('modalShowQR').classList.remove('hidden');
    }
</script>
@endsection
