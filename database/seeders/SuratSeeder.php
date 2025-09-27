<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\Perihal;

class SuratSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::where('email', 'admin@pptk.com')->first()->id;
        $perihal = Perihal::first();

        SuratMasuk::create([
            'nomor_surat' => 'SM-001/2025',
            'pengirim' => 'Dinas Pendidikan',
            'tanggal_surat' => now(),
            'perihal_id' => $perihal->id,
            'user_id' => $adminId,
            'file' => null
        ]);

        SuratKeluar::create([
            'nomor_surat' => 'SK-001/2025',
            'penerima' => 'Sekolah Negeri 1',
            'tanggal_surat' => now(),
            'perihal_id' => $perihal->id,
            'user_id' => $adminId,
            'file' => null
        ]);
    }
}
