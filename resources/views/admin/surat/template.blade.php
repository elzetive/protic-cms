<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Peminjaman - {{ $data['nomor_surat'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .page-surat {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 15mm 15mm 20mm 20mm;
            box-sizing: border-box;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            color: #000000;
            font-size: 12pt;
            line-height: 1.5;
        }

        .kop-border {
            border-bottom: 4px solid #000000;
            padding-bottom: 2px;
            margin-bottom: 20px;
        }
        .kop-inner-line {
            border-bottom: 1.5px solid #000000;
            padding-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-kiri {
            width: 135px;
            height: auto;
            display: block;
        }
        .logo-kanan {
            width: 95px;
            height: auto;
            display: block;
        }

        .text-kop {
            flex: 1;
            text-align: center;
            padding: 0 5px;
        }

        .text-kop h1, .text-kop h2, .text-kop h3 {
            font-size: 13pt !important;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.3;
        }

        .text-kop h2 {
            font-weight: normal !important;
        }

        .text-kop h1, .text-kop h3 {
            font-weight: bold !important;
        }

        .text-kop p {
            font-size: 11pt;
            font-family: 'Times New Roman', Times, serif;
            margin: 6px 0 0 0;
            line-height: 1.4;
            font-weight: normal;
            text-transform: none;
        }

        .link-resmi {
            color: #2563eb !important;
            text-decoration: underline !important;
        }

        .info-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .meta-kiri table {
            border-collapse: collapse;
        }
        .meta-kiri td {
            padding: 1px 0;
            vertical-align: top;
        }

        .text-hal {
            font-weight: bold !important;
            text-decoration: underline !important;
        }

        .meta-kanan {
            text-align: right;
            font-weight: normal;
        }

        .tujuan-surat {
            margin-bottom: 20px;
            line-height: 1.4;
        }
        .tujuan-surat p {
            margin: 0;
        }

        .paragraf-pembuka {
            text-align: justify;
            margin-bottom: 15px;
        }

        .tabel-detail-kegiatan {
            margin-left: 30px;
            margin-bottom: 15px;
            width: 85%;
            border-collapse: collapse;
        }
        .tabel-detail-kegiatan td {
            padding: 3px 0;
            vertical-align: top;
        }

        .paragraf-penutup {
            text-align: justify;
            margin-bottom: 35px;
        }

        .blok-ttd {
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
            margin-top: 30px;
        }
        .box-ttd {
            width: 48%;
            text-align: center;
        }
        .box-ttd .space-ttd {
            height: 85px;
        }

        .box-ttd .nama-pejabat {
            font-weight: normal !important;
            text-decoration: none !important;
            display: inline-block;
            border-bottom: 1px solid #000000;
            line-height: 0.8;
            padding-bottom: 1px;
            margin: 0;
            white-space: nowrap;
        }
        .box-ttd .identitas-id {
            margin: 5px 0 0 0;
            white-space: nowrap;
        }

        .action-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 12px;
            z-index: 9999;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
            border: none;
        }
        .btn-back {
            background-color: #ffffff;
            color: #374151;
        }
        .btn-back:hover { background-color: #f3f4f6; }
        .btn-print {
            background-color: #0a362d;
            color: #ffffff;
        }
        .btn-print:hover { background-color: #072620; }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                background-color: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .page-surat {
                width: 210mm !important;
                height: 297mm !important;
                padding: 15mm 15mm 20mm 20mm !important;
                box-shadow: none !important;
                margin: 0 auto !important;
                page-break-after: avoid !important;
                page-break-before: avoid !important;
            }
            .link-resmi {
                color: #2563eb !important;
                text-decoration: underline !important;
            }
            .box-ttd .nama-pejabat {
                border-bottom: 1px solid #000000 !important;
            }
            .action-floating {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="action-floating">
        <a href="{{ route('admin.surat.create') }}" class="btn btn-back">Kembali</a>
        <button onclick="window.print()" class="btn btn-print">Cetak PDF</button>
    </div>

    <div class="page-surat">

        <div class="kop-border">
            <div class="kop-inner-line">
                <div style="width: 130px; text-align: left;">
                    <img src="{{ asset('img/logo-pnc.png') }}" class="logo-kiri" alt="Logo PNC">
                </div>

                <div class="text-kop">
                    <h2>Kementerian Pendidikan Tinggi, Sains,<br>dan Teknologi</h2>
                    <h1>Politeknik Negeri Cilacap</h1>
                    <h3>Unit Kegiatan Mahasiswa PROTIC</h3>
                    <p>Jalan Dr. Soetomo No. 1, Sidakaya - Cilacap 53212, Jawa Tengah<br>
                    Telepon: (0282) 533329, Fax: (0282) 537992<br>
                    <span class="link-resmi">www.pnc.ac.id</span>, Email : <span class="link-resmi">ukm.pemrograman@pnc.ac.id</span></p>
                </div>

                <div style="width: 130px; text-align: right;">
                    <img src="{{ asset('img/logo.png') }}" class="logo-kanan" alt="Logo PROTIC">
                </div>
            </div>
        </div>

        <div class="info-header">
            <div class="meta-kiri">
                <table>
                    <tr>
                        <td style="width: 90px;">Nomor</td>
                        <td style="width: 15px;">:</td>
                        <td>{{ $data['nomor_surat'] }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td><span class="text-hal">{{ $data['hal'] }}</span></td>
                    </tr>
                </table>
            </div>

            <div class="meta-kanan">
                Cilacap, {{ str_replace(['Minggu, ', 'Senin, ', 'Selasa, ', 'Rabu, ', 'Kamis, ', 'Jumat, ', 'Sabtu, '], '', $data['tanggal_kegiatan']) }}
            </div>
        </div>

        <div class="tujuan-surat">
            <p>Kepada Yth.</p>
            <p>{{ $data['tujuan'] }}</p>
            <p>Politeknik Negeri Cilacap</p>
            <p>Di -</p>
            <p style="text-indent: 25px; margin: 0;">Tempat</p>
        </div>

        <div class="paragraf-pembuka">
            <p style="margin-bottom: 12px;">Dengan hormat,</p>
            <p style="margin: 0;">Sehubungan dengan penyelenggaraan {{ $data['agenda_kegiatan'] }}, kami bermaksud mengajukan permohonan peminjaman perlengkapan sebagai sarana prasarana pendukung kegiatan. Adapun kegiatan tersebut akan diselenggarakan pada:</p>
        </div>

        <table class="tabel-detail-kegiatan">
            <tr>
                <td style="width: 130px;">Hari, tanggal</td>
                <td style="width: 20px;">:</td>
                <td>{{ $data['tanggal_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ $data['waktu_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>:</td>
                <td>{{ $data['tempat_kegiatan'] }}</td>
            </tr>
        </table>

        <div class="paragraf-penutup">
            Demikian permohonan ini kami sampaikan. Atas perhatian dan izin yang diberikan, kami ucapkan terima kasih.
        </div>

        <div class="blok-ttd">
            <div class="box-ttd">
                <p style="margin: 0 0 5px 0;">Pembina PROTIC</p>
                <div class="space-ttd"></div>
                <p class="nama-pejabat">{{ $data['nama_pembina'] }}</p>
                <p class="identitas-id">NIP. {{ $data['nip_pembina'] }}</p>
            </div>

            <div class="box-ttd">
                <p style="margin: 0 0 5px 0;">Ketua PROTIC</p>
                <div class="space-ttd"></div>
                <p class="nama-pejabat">{{ $data['nama_ketua'] }}</p>
                <p class="identitas-id">NIM. {{ $data['nim_ketua'] }}</p>
            </div>
        </div>

    </div>

</body>
</html>
