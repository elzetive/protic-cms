<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        UserModel::create([
            'name' => 'Admin PROTIC',
            'username' => 'admin_protic',
            'email' => 'admin@protic.com',
            'password' => Hash::make('protic2026'),
        ]);
    }
}
