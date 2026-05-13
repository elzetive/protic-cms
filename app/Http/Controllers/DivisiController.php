<?php

namespace App\Http\Controllers;

use App\Models\PengurusModel;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function show($slug)
    {
        $mapDivisi = [
            'badan-pengurus-harian' => 'BADAN PENGURUS HARIAN',
            'divisi-kominfo'        => 'DIVISI KOMINFO',
            'divisi-humas'          => 'DIVISI HUMAS',
            'divisi-web'            => 'DIVISI WEB',
            'divisi-uiux'           => 'DIVISI UI/UX',
            'divisi-mobile'         => 'DIVISI MOBILE',
            'divisi-data'           => 'DIVISI DATA',
            'divisi-devops'         => 'DIVISI DEVOPS',
        ];

        $mapDesc = [
            'badan-pengurus-harian' => 'BPH berfungsi sebagai pusat pengambilan keputusan dan penentu arah strategis komunitas, memastikan semua aspek organisasi berjalan dengan baik dan sesuai dengan tujuan yang telah ditetapkan.',
            'divisi-kominfo'        => 'Divisi Kominfo dalam suatu komunitas bertugas untuk mengelola dan menyebarkan informasi secara efektif kepada seluruh anggota dan pihak luar. Divisi ini bertanggung jawab atas pembuatan konten, seperti berita, artikel, dan pengumuman, serta mengelola saluran komunikasi seperti media sosial, website, dan newsletter komunitas.',
            'divisi-humas'          => 'Divisi Humas bertanggung jawab untuk membangun dan menjaga citra positif melalui komunikasi yang efektif, baik secara internal maupun eksternal. Divisi ini mengelola hubungan dengan media, menyusun dan menyebarkan informasi kepada publik, serta merancang strategi komunikasi.',
            'divisi-web'            => 'Divisi ini bertanggung jawab pada pengembangan aplikasi berbasis web yang responsif dan aman. Fokus utamanya adalah membangun aplikasi front-end dan back-end menggunakan teknologi modern seperti HTML, CSS, JavaScript, serta framework seperti React dan backend seperti Node.js atau Laravel.',
            'divisi-uiux'           => 'Divisi UI/UX berfokus pada desain antarmuka pengguna dan pengalaman pengguna yang optimal. Selain desain visual, divisi ini juga mempelajari user research, usability testing, serta aplikasi yang digunakan sesuai dengan kebutuhan pengguna.',
            'divisi-mobile'         => 'Divisi ini berfokus pada pengembangan aplikasi untuk perangkat mobile, baik berbasis Android maupun iOS. Bahasa pemograman yang dipelajari seperti flutter, kotlin dan react native. Tujuannya adalah untuk menciptakan aplikasi mobile yang fungsional dan user-friendly.',
            'divisi-data'           => 'Divisi Data berfokus pada pengolahan, analisis, dan visualisasi data, seringkali mencakup data science, data mining, and machine learning. Divisi ini membekali anggota dengan kemampuan Python, SQL, serta visualisasi data untuk menghasilkan insight berbasis data.',
            'divisi-devops'         => 'Divisi Devops bertugas menjembatani pengembang (developer) and operasional, fokus pada otomatisasi siklus hidup perangkat lunak (CI/CD). Divisi ini meningkatkan kecepatan dan keandalan rilis produk melalui budaya kolaborasi, pemantauan sistem, dan pengelolaan infrastruktur.',
        ];

        $namaDivisiReal = $mapDivisi[$slug] ?? strtoupper(str_replace('-', ' ', $slug));
        $descDivisi = $mapDesc[$slug] ?? 'Bersama menciptakan inovasi dan kolaborasi hebat di lingkup ' . $namaDivisiReal;

        $periodeTerbaru = PengurusModel::max('angkatan');

        $members = PengurusModel::where('divisi', $namaDivisiReal)
                    ->where('angkatan', $periodeTerbaru)
                    ->orderByRaw("
                        CASE
                            WHEN UPPER(jabatan) = 'KETUA' THEN 1
                            WHEN UPPER(jabatan) = 'WAKIL KETUA' THEN 2
                            WHEN UPPER(jabatan) = 'SEKRETARIS' THEN 3
                            WHEN UPPER(jabatan) = 'BENDAHARA' THEN 4
                            WHEN UPPER(jabatan) = 'KEPALA DIVISI' THEN 5
                            ELSE 6
                        END
                    ")
                    ->get();

        $data = [
            'title'     => $namaDivisiReal,
            'desc'      => $descDivisi,
            'img_group' => $slug . '.jpg',
            'members'   => $members
        ];

        return view('user.divisi.show', compact('data'));
    }
}
