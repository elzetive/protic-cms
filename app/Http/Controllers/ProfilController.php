<?php

namespace App\Http\Controllers;

use App\Models\PengurusModel;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
public function index()
{
    $listDivisi = \App\Models\PengurusModel::select('divisi')
                    ->distinct()
                    ->whereNotNull('divisi')
                    ->orderByRaw("
                        CASE
                            WHEN divisi = 'BADAN PENGURUS HARIAN' THEN 1
                            WHEN divisi = 'DIVISI KOMINFO' THEN 2
                            WHEN divisi = 'DIVISI HUMAS' THEN 3
                            WHEN divisi = 'DIVISI WEB' THEN 4
                            WHEN divisi = 'DIVISI UI/UX' THEN 5
                            WHEN divisi = 'DIVISI MOBILE' THEN 6
                            WHEN divisi = 'DIVISI DATA' THEN 7
                            WHEN divisi = 'DIVISI DEVOPS' THEN 8
                            ELSE 9
                        END
                    ")
                    ->get();

    return view('user.profil', compact('listDivisi'));
}}
