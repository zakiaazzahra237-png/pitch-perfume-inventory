<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Nama diubah jadi Zakia)
        User::create([
            'name' => 'Zakia',
            'email' => 'admin',
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);

        // 2. Akun Staff
        User::create([
            'name' => 'Staff Toko',
            'email' => 'staff',
            'password' => Hash::make('12345'),
            'role' => 'staff',
        ]);
    }
}