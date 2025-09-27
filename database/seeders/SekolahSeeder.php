<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SekolahSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'SD Sukamaju',
            'email' => 'sdsukamaju@pptk.com',
            'password' => Hash::make('sekolahsd123'),
            'role' => 'sekolah_sd',
        ]);
        User::create([
            'name' => 'SMP Sukamaju',
            'email' => 'smpsukamaju@pptk.com',
            'password' => Hash::make('sekolahsmp123'),
            'role' => 'sekolah_smp',
        ]);
    }
}
