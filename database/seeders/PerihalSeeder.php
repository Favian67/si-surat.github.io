<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perihal;

class PerihalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['judul' => 'Undangan', 'deskripsi' => 'Surat undangan resmi'],
            ['judul' => 'Pengumuman', 'deskripsi' => 'Informasi umum'],
            ['judul' => 'Pemberitahuan', 'deskripsi' => 'Surat pemberitahuan kegiatan'],
        ];

        foreach ($data as $item) {
            Perihal::create($item);
        }
    }
}
