<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProkerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Program Kerja',
            'desc' => 'Program kerja Protic PNC periode ini difokuskan sebagai wadah kolaborasi untuk mencetak kader yang kompeten dalam pengembangan perangkat lunak dan inovasi digital melalui pelatihan intensif serta pengerjaan proyek nyata. Dengan semangat kekeluargaan, kita berkomitmen menjadikan Protic sebagai motor penggerak teknologi di Politeknik Negeri Cilacap yang mampu menghasilkan karya solutif bagi kebutuhan kampus maupun masyarakat luas.',
            'img_main' => 'proker.jpg',
            'programs' => [
                ['name' => 'Study Jam Web Basic', 'img' => 'web-basic.jpg'],
                ['name' => 'Study Jam Web Advance', 'img' => 'web-advance.jpg'],
                ['name' => 'Study Jam Mobile', 'img' => 'mobile.jpg'],
                ['name' => 'Study Jam UI/UX', 'img' => 'uiux.jpg'],
                ['name' => 'Study Jam Data', 'img' => 'data.jpg'],
                ['name' => 'Study Jam Devops', 'img' => 'devops.jpg'],
            ]
        ];

        return view('user.proker', compact('data'));
    }
}
