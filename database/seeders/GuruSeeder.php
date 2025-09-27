<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Yatno',
            'email' => 'gurusmp1@pptk.com',
            'password' => Hash::make('gurusmp1'),
            'role' => 'guru_smp'
        ]);
        User::create([
            'name' => 'Yanto',
            'email' => 'gurusd1@pptk.com',
            'password' => Hash::make('gurusd1'),
            'role' => 'guru_sd'
        ]);
    }
}
