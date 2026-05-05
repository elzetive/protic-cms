<?php

namespace Database\Seeders;

use App\Models\UserModel;
use App\Models\PengurusModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin PROTIC',
            'email' => 'admin@protic.com',
            'password' => Hash::make('protic2026'),
        ]);

        PengurusModel::create([
            'nama' => 'Dimas Riyan Wirayuda',
            'nim' => '240302039',
            'jabatan' => 'HUMAS',
            'divisi' => 'DIVISI HUMAS',
            'angkatan' => 2026,
            'instagram' => '@dimasriyan',
            'foto' => null
        ]);
    }
}
