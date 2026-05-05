<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusModel;
use App\Models\KontenModel;
use App\Models\KasModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $periodeTerbaru = PengurusModel::max('angkatan');

    $countPengurus = PengurusModel::where('angkatan', $periodeTerbaru)->count();

    $saldoKas = KasModel::sum('nominal');
    $countProker = KontenModel::where('kategori', 'Proker')->count();

    $latestActivity = KasModel::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'countPengurus',
        'saldoKas',
        'countProker',
        'latestActivity',
        'periodeTerbaru'
    ));
}
}
