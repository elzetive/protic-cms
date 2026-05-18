<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Peminjaman - PROTIC PNC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            .print-area {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            @page {
                size: A4;
                margin: 1.5cm 1.5cm 1.5cm 1.5cm;
            }
        }

        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .surat-text {
            font-family: 'Times New Roman', Times, serif;
        }

        .kop-border {
            border-bottom: 4px solid black;
            padding-bottom: 2px;
            margin-bottom: 20px;
        }
        .kop-inner-line {
            border-bottom: 1.5px solid black;
            padding-bottom: 2px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-4 print:py-0">

    <div class="max-w-4xl mx-auto mb-4 p-4 bg-white shadow-md rounded-xl flex justify-between items-center no-print">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pratinjau Lembar Surat Resmi</span>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-[#0a362d] text-white px-6 py-2.5 rounded-lg text-xs font-black uppercase tracking-wider hover:bg-amber-600 transition-all shadow-md active:scale-95">
                Cetak PDF
            </button>
        </div>
    </div>

    <div class="print-area max-w-4xl mx-auto bg-white px-[1.5cm] py-[1.5cm] print:p-0 shadow-2xl text-black text-[16px] leading-relaxed surat-text">

        <div class="kop-border">
            <div class="kop-inner-line flex items-center justify-between pb-1">
                <div class="w-32 shrink-0 text-left">
                    <img src="{{ asset('img/logo-pnc.png') }}" class="w-28 h-auto object-contain" alt="Logo PNC">
                </div>

                <div class="text-center flex-grow px-1">
                    <h2 class="text-[15px] font-normal uppercase tracking-wide leading-tight text-black">
                        Kementerian Pendidikan Tinggi, Sains,<br>dan Teknologi
                    </h2>
                    <h2 class="text-[17px] font-bold uppercase tracking-wide leading-tight text-black mt-0.5">Politeknik Negeri Cilacap</h2>
                    <h3 class="text-[15px] font-bold uppercase tracking-widest leading-normal text-black">Unit Kegiatan Mahasiswa PROTIC</h3>
                    <p class="text-[10px] font-normal leading-tight mt-1 font-sans text-black">Jalan Dr. Soetomo No.1, Sidakaya - Cilacap 53212, Jawa Tengah</p>
                    <p class="text-[10px] font-normal leading-tight font-sans text-black">Telepon: (0282) 533329, Fax: (0282) 537992</p>
                    <p class="text-[10px] font-normal leading-tight font-sans text-black">
                        <span class="text-blue-600 underline">www.pnc.ac.id</span>, Email : <span class="text-blue-600 underline">ukm.pemrograman@pnc.ac.id</span>
                    </p>
                </div>

                <div class="w-32 shrink-0 text-right">
                    <img src="{{ asset('img/logo.png') }}" class="w-24 h-auto ml-auto object-contain" alt="Logo PROTIC">
                </div>
            </div>
        </div>

        <div class="text-right mb-4">
            Cilacap, {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y') }}
        </div>

        <div class="grid grid-cols-12 gap-0.5 mb-4">
            <div class="col-span-2">Nomor</div>
            <div class="col-span-10">: {{ $data['nomor_surat'] }}</div>
            <div class="col-span-2">Lampiran</div>
            <div class="col-span-10">: -</div>
            <div class="col-span-2">Hal</div>
            <div class="col-span-10">: <span class="underline">{{ $data['hal'] }}</span></div>
        </div>

        <div class="mb-4 leading-normal">
            <p>Kepada</p>
            <p>{{ $data['tujuan'] }}</p>
            <p>Politeknik Negeri Cilacap</p>
            <p>di -</p>
            <p class="pl-5">tempat</p>
        </div>

        <div class="mb-4 text-justify">
            <p class="mb-2">Dengan hormat,</p>
            <p>Sehubungan dengan penyelenggaraan {{ $data['agenda_kegiatan'] }}, kami bermaksud mengajukan permohonan peminjaman perlengkapan sebagai sarana prasarana pendukung kegiatan. Adapun kegiatan tersebut akan diselenggarakan pada:</p>
        </div>

        <div class="pl-10 grid grid-cols-12 gap-1 mb-4">
            <div class="col-span-3">Hari, tanggal</div>
            <div class="col-span-9">: {{ $data['tanggal_kegiatan'] }}</div>
            <div class="col-span-3">Waktu</div>
            <div class="col-span-9">: {{ $data['waktu_kegiatan'] }}</div>
            <div class="col-span-3">Tempat</div>
            <div class="col-span-9">: {{ $data['tempat_kegiatan'] }}</div>
        </div>

        <div class="mb-6 text-justify">
            Demikian permohonan ini kami sampaikan. Atas perhatian dan izin yang diberikan, kami ucapkan terima kasih.
        </div>

        <div class="grid grid-cols-2 text-center mt-4">
            <div>
                <p class="mb-16">Pembina PROTIC</p>
                <p class="underline inline-block text-black">{{ $data['nama_pembina'] }}</p>
                <p class="text-[15px] mt-0.5">NIP. {{ $data['nip_pembina'] }}</p>
            </div>
            <div>
                <p class="mb-16">Ketua PROTIC</p>
                <p class="underline inline-block text-black">{{ $data['nama_ketua'] }}</p>
                <p class="text-[15px] mt-0.5">NIM. {{ $data['nim_ketua'] }}</p>
            </div>
        </div>

    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
