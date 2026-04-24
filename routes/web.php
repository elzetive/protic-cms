<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DivisiController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Route::get('/divisi/{slug}', [DivisiController::class, 'show'])->name('divisi.show');
