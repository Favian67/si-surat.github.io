<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KorwilSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Korwil',
            'email' => 'korwil@pptk.com',
            'password' => Hash::make('korwil123'),
            'role' => 'korwil'
        ]);
    }
}
