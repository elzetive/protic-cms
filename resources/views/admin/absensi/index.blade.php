@extends('admin.layouts.admin')

@section('content')
<div class="h-[calc(100vh-120px)] flex flex-col space-y-4 animate-in fade-in duration-500 overflow-hidden">

    <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 shrink-0">
        <div>
            <h1 class="text-xl font-black text-[#0a362d] uppercase tracking-widest leading-none">Absensi Kegiatan</h1>
            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1.5 italic">Kelola daftar hadir pengurus & anggota PROTIC</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-[8px] font-black text-amber-600 bg-amber-50 px-3 py-1.5 rounded-xl uppercase border border-amber-100">
                Update: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }} WIB
            </span>
            <button onclick="document.getElementById('modalTambahKegiatan').classList.remove('hidden')"
                class="bg-[#0a362d] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-amber-600 transition-all shadow-md active:scale-95">
                <i class="fa-solid fa-plus-circle text-xs"></i> Buat Kegiatan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 shrink-0">
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between px-8 relative overflow-hidden group">
            <div class="relative z-10 text-left">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Kegiatan</p>
                <h4 class="text-xl font-black text-[#0a362d]">{{ $kegiatan->count() }}</h4>
            </div>
            <i class="fa-solid fa-calendar-check text-3xl text-gray-50 group-hover:text-amber-50 transition-colors"></i>
        </div>
        <div class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between px-8 relative overflow-hidden group">
            <div class="relative z-10 text-left">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Sistem</p>
                <h4 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">QR Scanner Active</h4>
            </div>
            <i class="fa-solid fa-qrcode text-3xl text-gray-50 group-hover:text-emerald-50 transition-colors"></i>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col flex-1 min-h-0">
        <div class="px-6 py-3.5 border-b border-gray-50 flex justify-between items-center bg-gray-50/20 shrink-0">
            <h4 class="font-black text-[#0a362d] uppercase text-[9px] tracking-[0.2em]">Daftar Riwayat Kegiatan</h4>
        </div>

        <div class="flex-1 overflow-y-auto no-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[8px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-100 sticky top-0 z-10">
                        <th class="px-8 py-4">Nama Kegiatan & Lokasi</th>
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-4 py-4 text-center">Kehadiran</th>
                        <th class="px-4 py-4 text-center">QR Code</th>
                        <th class="px-8 py-4 text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] font-bold text-[#0a362d] divide-y divide-gray-50 uppercase">
                    @forelse ($kegiatan as $item)
                    <tr class="hover:bg-gray-50/50 transition-all group cursor-pointer"
                        onclick="window.location='{{ route('admin.absensi.show', $item->id) }}'">

                        <td class="px-8 py-3 text-left">
                            <span class="block font-black tracking-tight text-[#0a362d]">{{ $item->nama_kegiatan }}</span>
                            <span class="text-[7px] text-gray-400 font-black tracking-widest flex items-center gap-1 mt-0.5 uppercase">
                                <i class="fa-solid fa-location-dot text-amber-500"></i> {{ $item->lokasi }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-left">
                            <span class="block text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                            <span class="text-[8px] font-black text-[#0a362d] mt-0.5 block">Pukul {{ $item->waktu }} WIB</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-lg text-[7px] font-black tracking-widest border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                {{ $item->kehadiran->count() }} HADIR
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center" onclick="event.stopPropagation()">
                            <button onclick="showQR('{{ $item->token_absensi }}', '{{ $item->nama_kegiatan }}')"
                                class="w-8 h-8 rounded-lg bg-white text-[#0a362d] hover:bg-[#0a362d] hover:text-white transition-all flex items-center justify-center mx-auto border border-gray-100 shadow-sm active:scale-90">
                                <i class="fa-solid fa-qrcode text-xs"></i>
                            </button>
                        </td>
                        <td class="px-8 py-3 text-center" onclick="event.stopPropagation()">
                            <form action="{{ route('admin.absensi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-rose-600 transition-colors p-2">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-300 uppercase text-[9px] tracking-widest italic font-bold">
                            Belum ada kegiatan absensi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambahKegiatan" class="fixed inset-0 z-[100] hidden bg-[#0a362d]/60 backdrop-blur-sm flex items-center justify-center p-4 animate-in fade-in duration-300">
    <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl animate-in zoom-in duration-300 text-left">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-sm font-black text-[#0a362d] uppercase tracking-widest">Buat Absensi</h3>
            <button onclick="document.getElementById('modalTambahKegiatan').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-rose-500 transition-all">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form action="{{ route('admin.absensi.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-1.5 uppercase">
                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" required placeholder="NAMA KEGIATAN" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 transition-all text-[#0a362d]">
            </div>

            <div class="grid grid-cols-2 gap-4 uppercase">
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d]">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Waktu</label>
                    <input type="time" name="waktu" required class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d]">
                </div>
            </div>

            <div class="space-y-1.5 uppercase">
                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi</label>
                <input type="text" name="lokasi" required placeholder="LOKASI KEGIATAN" class="w-full bg-gray-50 border-none py-3 px-5 rounded-xl text-xs font-bold focus:ring-1 focus:ring-amber-500 text-[#0a362d]">
            </div>

            <button type="submit" class="w-full bg-[#0a362d] text-white py-4 rounded-2xl text-[9px] font-black uppercase tracking-widest shadow-lg active:scale-95 transition-all mt-2 hover:bg-amber-600">
                Simpan & Generate QR
            </button>
        </form>
    </div>
</div>

<div id="modalShowQR" class="fixed inset-0 z-[110] hidden bg-[#0a362d]/90 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-sm p-8 text-center animate-in zoom-in duration-300 relative border border-white/20">
        <button onclick="document.getElementById('modalShowQR').classList.add('hidden')" class="absolute top-6 right-6 text-gray-300 hover:text-rose-500 transition-all">
            <i class="fa-solid fa-circle-xmark text-2xl"></i>
        </button>

        <h3 id="qrTitle" class="text-sm font-black text-[#0a362d] uppercase tracking-widest mb-1 px-6 truncate text-center">QR ABSENSI</h3>
        <p class="text-[8px] text-gray-400 uppercase font-bold tracking-widest mb-6 italic text-center">Scan untuk presensi</p>

        <div class="bg-gray-50 p-6 rounded-2xl border-2 border-dashed border-gray-100 flex items-center justify-center mb-6">
            <div id="qrContent" class="w-44 h-44 bg-white flex items-center justify-center rounded-xl shadow-xl overflow-hidden border-8 border-white">
                <i class="fa-solid fa-spinner animate-spin text-4xl text-gray-200"></i>
            </div>
        </div>

        <p class="text-[8px] font-black text-[#0a362d] uppercase tracking-[0.3em] mb-1">PROTIC PNC SYSTEM</p>
        <div class="h-1 w-12 bg-amber-500 mx-auto rounded-full"></div>
    </div>
</div>

<script>
    function showQR(token, title) {
        document.getElementById('qrTitle').innerText = title;
        const qrContainer = document.getElementById('qrContent');
        const baseUrl = window.location.origin;
        const absenUrl = `${baseUrl}/absen/${token}`;
        const qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(absenUrl)}&qzone=1`;

        qrContainer.innerHTML = '<i class="fa-solid fa-spinner animate-spin text-4xl text-gray-200"></i>';

        const img = new Image();
        img.src = qrImageUrl;
        img.className = 'w-full h-full object-cover';
        img.onload = function() {
            qrContainer.innerHTML = '';
            qrContainer.appendChild(img);
        };

        document.getElementById('modalShowQR').classList.remove('hidden');
    }
</script>
@endsection
