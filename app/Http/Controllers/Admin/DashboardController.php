<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengurusModel;
use App\Models\KontenModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countPengurus = PengurusModel::count();
        $countProker = KontenModel::where('kategori', 'Proker')->count();
        $countPrestasi = KontenModel::where('kategori', 'Prestasi')->count();
        $countPeriode = PengurusModel::distinct('angkatan')->count('angkatan');

        $latestPengurus = PengurusModel::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'countPengurus',
            'countProker',
            'countPrestasi',
            'countPeriode',
            'latestPengurus'
        ));
    }
}
