<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KasController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\SuratController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/divisi/{slug}', [DivisiController::class, 'show'])->name('divisi.show');
Route::get('/proker', [ProkerController::class, 'index'])->name('proker');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/konten/{slug}', [BerandaController::class, 'show'])->name('konten.detail');

Route::get('/absen/{token}', [AbsensiController::class, 'showFormAbsen'])->name('absensi.form');
Route::post('/absen/simpan', [AbsensiController::class, 'submitAbsen'])->name('absensi.submit');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::get('/admin/login', function () { return view('auth.login'); })->name('admin.login');
    Route::post('/login', [AuthController::class, 'loginAuthenticate'])->name('login.submit');
    Route::get('/register', function () { return view('auth.register'); })->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(KontenController::class)->group(function () {
        Route::get('/konten', 'index')->name('admin.konten.index');
        Route::get('/konten/tambah', 'create')->name('admin.konten.tambah');
        Route::post('/konten/simpan', 'store')->name('admin.konten.store');
        Route::get('/konten/edit/{id}', 'edit')->name('admin.konten.edit');
        Route::put('/konten/update/{id}', 'update')->name('admin.konten.update');
        Route::delete('/konten/hapus/{id}', 'destroy')->name('admin.konten.destroy');
    });

    Route::controller(PengurusController::class)->group(function () {
        Route::get('/database', 'index')->name('admin.database.index');
        Route::get('/database/tambah', 'create')->name('admin.database.tambah');
        Route::post('/database/simpan', 'store')->name('admin.database.store');
        Route::get('/database/edit/{id}', 'edit')->name('admin.database.edit');
        Route::put('/database/update/{id}', 'update')->name('admin.database.update');
        Route::delete('/database/hapus/{id}', 'destroy')->name('admin.database.destroy');
        Route::post('/database/clone/{id}', 'clone')->name('admin.database.clone');
        Route::post('/database/bulk-clone', 'bulkClone')->name('admin.database.bulkClone');
        Route::post('/database/bulk-delete', 'bulkDestroy')->name('admin.database.bulkDestroy');
    });

    Route::prefix('kas')->group(function() {
        Route::controller(KasController::class)->group(function () {
            Route::get('/transaksi', 'indexTransaksi')->name('admin.kas.index');
            Route::post('/transaksi/simpan', 'store')->name('admin.kas.store');
            Route::get('/transaksi/detail/{id}', 'show')->name('admin.kas.show');
            Route::put('/transaksi/update/{id}', 'update')->name('admin.kas.update');
            Route::delete('/transaksi/hapus/{id}', 'destroy')->name('admin.kas.destroy');

            Route::get('/iuran', 'indexIuran')->name('admin.iuran.index');
            Route::get('/iuran/tambah', 'createIuran')->name('admin.iuran.tambah');
            Route::get('/iuran/rekap/{periode}/{bulan}', 'detailIuran')->name('admin.iuran.rekap');
            Route::get('/iuran/show/{nama}', 'showIuran')->name('admin.iuran.show');
        });
    });

    Route::prefix('absensi')->group(function() {
        Route::controller(AbsensiController::class)->group(function () {
            Route::get('/', 'index')->name('admin.absensi.index');
            Route::post('/simpan', 'store')->name('admin.absensi.store');
            Route::get('/detail/{id}', 'show')->name('admin.absensi.show');
            Route::delete('/hapus/{id}', 'destroy')->name('admin.absensi.destroy');
        });
    });

    Route::prefix('arsip')->group(function() {
        Route::controller(ArsipController::class)->group(function () {
            Route::get('/', 'index')->name('admin.arsip.index');
            Route::get('/tambah', 'tambah')->name('admin.arsip.tambah');
            Route::post('/simpan', 'store')->name('admin.arsip.store');
            Route::delete('/hapus/{id}', 'destroy')->name('admin.arsip.destroy');
        });
    });

    Route::prefix('surat')->group(function() {
        Route::controller(SuratController::class)->group(function () {
            Route::get('/', 'index')->name('admin.surat.index');
            Route::get('/tambah', 'create')->name('admin.surat.create');
            Route::post('/simpan', 'storeAndPrint')->name('admin.surat.store');
            Route::get('/cetak-ulang/{id}', 'printFromIndex')->name('admin.surat.cetak');
        });
    });

});
