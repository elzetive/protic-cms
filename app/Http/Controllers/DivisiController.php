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
                'bg_color' => 'bg-[#546e6a]',
                'members' => [
                    ['name' => 'Ilham Budi Trisetyo', 'role' => 'Ketua', 'img' => 'ketua.jpeg'],
                    ['name' => 'Adhitya Putra Arif', 'role' => 'Wakil Ketua', 'img' => 'wakil.jpeg'],
                    ['name' => 'Genice Alexa Olivia', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Alivia Nufadlia', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Almas Salsabila Fidiarti', 'role' => 'Sekretaris', 'img' => 'sekretaris.jpeg'],
                    ['name' => 'Sulis Rahayu', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                    ['name' => 'Ahmad Fakhri Abdullah', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                    ['name' => 'Dea Ameliana Saputri', 'role' => 'Bendahara', 'img' => 'bendahara.jpeg'],
                ]
            ],
            'web' => [
                'title' => 'Divisi Web Development',
                'desc' => 'Berfokus pada pengembangan aplikasi berbasis web menggunakan teknologi terbaru.',
                'img_group' => 'web-group.jpg',
                'bg_color' => 'bg-[#0a362d]',
                'members' => [
                    ['name' => 'Anggota Web 1', 'role' => 'Koordinator', 'img' => 'web1.jpeg'],
                ]
            ],
        ];

        $data = $allDivisi[$slug] ?? abort(404);

        return view('divisi.' . $slug, compact('data'));
    }
}
