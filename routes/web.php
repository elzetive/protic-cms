<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\PrestasiController;

// Import Admin Controllers
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\DashboardController; // Tambahkan ini jika dashboard mau dinamis

/*
|--------------------------------------------------------------------------
| Web Routes - UKM PROTIC PNC
|--------------------------------------------------------------------------
*/

// --- ROUTE USER (TAMPILAN PUBLIK) ---
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/divisi/{slug}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('/proker', [ProkerController::class, 'index'])->name('proker');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/konten/{slug}', [BerandaController::class, 'show'])->name('konten.detail');


// --- ROUTE AUTH (LOGIN & REGISTER) ---
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');


// --- ROUTE ADMIN (MANAGEMENT SYSTEM) ---
Route::prefix('admin')->group(function () {

    // --- Login & Logout Admin ---
    Route::get('/login', function () { return view('auth.login'); })->name('admin.login');
    Route::post('/logout', function () {
        return redirect()->route('admin.login');
    })->name('logout');

    // --- Dashboard ---
    // Gunakan controller jika ingin menampilkan statistik dinamis
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // --- Manajemen Konten (PROKER & PRESTASI) ---
    Route::get('/konten', [KontenController::class, 'index'])->name('admin.konten.index');
    Route::get('/konten/tambah', [KontenController::class, 'create'])->name('admin.konten.tambah');
    Route::post('/konten/simpan', [KontenController::class, 'store'])->name('admin.konten.store');
    Route::get('/konten/edit/{id}', [KontenController::class, 'edit'])->name('admin.konten.edit'); // ADDED
    Route::put('/konten/update/{id}', [KontenController::class, 'update'])->name('admin.konten.update'); // ADDED
    Route::delete('/konten/hapus/{id}', [KontenController::class, 'destroy'])->name('admin.konten.destroy');

    // --- Manajemen Database Pengurus ---
    Route::get('/database', [PengurusController::class, 'index'])->name('admin.database.index');
    Route::get('/database/tambah', [PengurusController::class, 'create'])->name('admin.database.tambah');
    Route::post('/database/simpan', [PengurusController::class, 'store'])->name('admin.database.store');
    Route::get('/database/edit/{id}', [PengurusController::class, 'edit'])->name('admin.database.edit'); // ADDED
    Route::put('/database/update/{id}', [PengurusController::class, 'update'])->name('admin.database.update'); // ADDED
    Route::delete('/database/hapus/{id}', [PengurusController::class, 'destroy'])->name('admin.database.destroy');

    // --- Manajemen Kas (Transaksi) ---
    Route::get('/kas/transaksi', function () {
        return view('admin.kas.transaksi.index');
    })->name('admin.kas.index');
    Route::get('/kas/transaksi/detail', function () {
        return view('admin.kas.transaksi.detail');
    })->name('admin.kas.detail');
    Route::get('/kas/transaksi/tambah', function () {
        return view('admin.kas.transaksi.tambah');
    })->name('admin.kas.tambah');

    // --- Manajemen Kas (Iuran) ---
    Route::get('/kas/iuran', function () {
        return view('admin.kas.iuran.index');
    })->name('admin.iuran.index');
    Route::get('/kas/iuran/detail', function () {
        return view('admin.kas.iuran.detail');
    })->name('admin.kas.detail_iuran');
    Route::get('/kas/iuran/tambah', function () {
        return view('admin.kas.iuran.tambah');
    })->name('admin.iuran.tambah');

    // --- Manajemen Arsip ---
    Route::get('/arsip', function () {
        return view('admin.arsip.index');
    })->name('admin.arsip.index');
    Route::get('/arsip/tambah', function () {
        return view('admin.arsip.tambah');
    })->name('admin.arsip.tambah');

    // --- Manajemen Absensi ---
    Route::get('/absensi', function () {
        return view('admin.absensi.index');
    })->name('admin.absensi.index');
    Route::get('/absensi/tambah', function () {
        return view('admin.absensi.tambah');
    })->name('admin.absensi.tambah');
    Route::get('/absensi/detail', function () {
        return view('admin.absensi.detail');
    })->name('admin.absensi.detail');
    Route::get('/absensi/bagikan', function () {
        return view('admin.absensi.bagikan');
    })->name('admin.absensi.qrcode');

});
