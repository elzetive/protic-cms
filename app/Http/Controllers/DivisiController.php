<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function show($slug)
    {
        $allDivisi = [
            'bph' => [
                'title' => 'Badan Pengurus Harian',
                'desc' => 'BPH berfungsi sebagai pusat pengambilan keputusan dan penentu arah strategis komunitas, memastikan semua aspek organisasi berjalan dengan baik dan sesuai dengan tujuan yang telah ditetapkan.',
                'img_group' => 'bph.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Ilham Budi Trisetyo', 'role' => 'Ketua', 'img' => 'ketua.jpeg'],
                    ['name' => 'Adhitya Putra Arif N.', 'role' => 'Wakil Ketua', 'img' => 'wakil.jpeg'],
                    ['name' => 'Genice Alexa Olivia', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Alivia Nufadlia', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Almas Salsabila Fidiarti', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Sulis Rahayu', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                    ['name' => 'Ahmad Fakhri Abdullah', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                    ['name' => 'Dea Ameliana Saputri', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                ]
            ],
            'kominfo' => [
                'title' => 'Divisi Kominfo',
                'desc' => 'Divisi Kominfo bertugas untuk mengelola dan menyebarkan informasi secara efektif kepada seluruh anggota dan pihak luar. Divisi ini bertanggung jawab atas pembuatan konten, seperti berita, artikel, dan pengumuman, serta mengelola saluran komunikasi seperti media sosial.',
                'img_group' => 'kominfo.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Giska Saputra', 'role' => 'Kepala Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'Exellinda Alicia Putri', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'M. Husain Nurfadhillah', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'Kayla Radifan P.', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'Panji Parisya Akmal H.', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'Rindang Permatasari', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                    ['name' => 'Tsamara Zharifah Y.', 'role' => 'Anggota Divisi', 'img' => 'jokowi.jpg'],
                ]
            ],
            'humas' => [
                'title' => 'Divisi Humas',
                'desc' => 'Divisi Humas bertanggung jawab untuk membangun dan menjaga citra positif melalui komunikasi yang efektif, baik secara internal maupun eksternal. Divisi ini mengelola hubungan dengan media, menyusun dan menyebarkan informasi kepada publik, serta merancang strategi komunikasi.',
                'img_group' => 'humas.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Dimas Riyan Wirayuda', 'role' => 'Kepala Divisi', 'img' => 'humas1.jpg'],
                    ['name' => 'Hanny Nur Rahmawati', 'role' => 'Anggota Divisi', 'img' => 'humas1.jpg'],
                    ['name' => 'Rahmawati', 'role' => 'Anggota Divisi', 'img' => 'humas1.jpg'],
                    ['name' => 'Sofyan Yunus Rohman', 'role' => 'Anggota Divisi', 'img' => 'humas1.jpg'],
                ]
            ],
            'web' => [
                'title' => 'Divisi Web',
                'desc' => 'Divisi ini bertanggung jawab pada pengembangan aplikasi berbasis web yang responsif dan aman. Fokus utamanya adalah membangun aplikasi front-end dan back-end menggunakan teknologi modern seperti HTML, CSS, JavaScript, serta framework seperti React dan backend seperti Node.js atau Laravel.',
                'img_group' => 'web.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Christian Luis PG.', 'role' => 'Kepala Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Akmal Firmansyah', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Fairuz Naufal Arkhan', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Mohamad Gamar', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Afif Nur Faizin', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Assyifa Saisarita', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Bagus Daffa Albany', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Pradipa Dary Ahnaf', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Sukmaratih Nirmala S.', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Tisna Prima Ramadhan', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                ]
            ],
            'uiux' => [
                'title' => 'Divisi UI/UX',
                'desc' => 'Divisi UI/UX berfokus pada desain antarmuka pengguna dan pengalaman pengguna yang optimal. Selain desain visual, divisi ini juga mempelajari user research, usability testing, serta aplikasi yang digunakan sesuai dengan kebutuhan pengguna.',
                'img_group' => 'uiux.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Figo Firgiawan', 'role' => 'Kepala Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Hilmi Mubarok', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Chyntia Alivia Arnosty', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Enzy Madona Ika Safitri', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Galuh Dwi Putra', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Lussy Ana Syarif', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                ]
            ],
            'mobile' => [
                'title' => 'Divisi Mobile',
                'desc' => 'Divisi ini berfokus pada pengembangan aplikasi untuk perangkat mobile, baik berbasis Android maupun iOS. Bahasa pemograman yang dipelajari seperti flutter, kotlin dan react native. Tujuannya adalah untuk menciptakan aplikasi mobile yang fungsional dan user-friendly.',
                'img_group' => 'mobile.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Alea Casanova', 'role' => 'Kepala Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Zahwa Ayu Ramadhani', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'M. Hadist Rifannan', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Bhadra Nur Rouf Rudin', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Bintang Fajar Jolya A.', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Hazel Ransy Krishna', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Raja Ubaid Fawwaz', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                ]
            ],
            'data' => [
                'title' => 'Divisi Data',
                'desc' => 'Divisi Data berfokus pada pengolahan, analisis, dan visualisasi data, seringkali mencakup data science, data mining, dan machine learning. Divisi ini membekali anggota dengan kemampuan Python, SQL, serta visualisasi data untuk menghasilkan insight berbasis data.',
                'img_group' => 'data.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Fachri Rasyiq Pramana', 'role' => 'Kepala Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Fajar S. Huda', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Gendhis Yuwita Sari', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Igo Ilham Ramadhan', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Namira Davina RM.', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Raihan Afdhal A.', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                ]
            ],
            'devops' => [
                'title' => 'Divisi Devops',
                'desc' => 'Divisi Devops  bertugas menjembatani pengembang (developer) dan operasional, fokus pada otomatisasi siklus hidup perangkat lunak (CI/CD). Divisi ini meningkatkan kecepatan dan keandalan rilis produk melalui budaya kolaborasi, pemantauan sistem, dan pengelolaan infrastruktur.',
                'img_group' => 'devops.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Rahmat Mulyadi', 'role' => 'Kepala Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Rizal Rokhmat Fadillah', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Alif Ekto Rizkyawan', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'M. Ridho Hidayat', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Ade Ariansyah Anggoro', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Ari Dwi Saputra', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Hikmal', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                    ['name' => 'Nafisa Raihana', 'role' => 'Anggota Divisi', 'img' => 'web1.jpeg'],
                ]
            ],
        ];

        $data = $allDivisi[$slug] ?? abort(404);
        return view('user.divisi.show', compact('data'));
    }
}
