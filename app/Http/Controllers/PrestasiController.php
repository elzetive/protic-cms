<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Prestasi',
            'desc' => 'UKM PROTIC PNC terus mencetak generasi berprestasi di tingkat nasional maupun internasional. Melalui semangat inovasi dan kerja keras, para anggota kami telah meraih berbagai penghargaan bergengsi di bidang teknologi informasi, pengembangan perangkat lunak, hingga desain kreatif.',
            'img_main' => 'prestasi.jpg',
            'achievements' => [
                [
                    'title' => 'JUARA 3 ITECHNO CUP FRONT-END DEVELOPMENT',
                    'sub' => 'Juara 3 - ITECHNO CUP 2025',
                    'detail' => 'Kategori Front-End Development',
                    'img' => 'p1.jpg'
                ],
                [
                    'title' => 'JUARA 2 KATEGORI POSTER CIPTA INOVASI TIK - KMPN VII',
                    'sub' => 'Juara 2 - KMPN VII',
                    'detail' => 'Kategori Poster Cipta Inovasi Bidang TIK',
                    'img' => 'p2.jpg'
                ],
                [
                    'title' => 'JUARA 2 UI/UX DESIGN ITCOMP 2025 POLNES',
                    'sub' => 'Juara 2 - IT COMP 2025',
                    'detail' => 'Kategori UI/UX Design',
                    'img' => 'p3.jpg'
                ],
                [
                    'title' => 'JUARA 2 IT BUSINESS ITFEST X FTJ 2025',
                    'sub' => 'Juara 2 - IT FEST x FTJ 2025',
                    'detail' => 'Kategori IT Business',
                    'img' => 'p4.jpg'
                ],
                [
                    'title' => 'JUARA HARAPAN 1 WEB DEVELOPMENT ITASE 6.0',
                    'sub' => 'Juara Harapan 1 - ITASE 6.0',
                    'detail' => 'Kategori Web Development',
                    'img' => 'p5.jpg'
                ],
            ]
        ];

        return view('user.prestasi', compact('data'));
    }
}
