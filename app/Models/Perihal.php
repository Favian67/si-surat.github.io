<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perihal extends Model
{
    protected $fillable = ['judul', 'deskripsi'];

    // Relasi ke Surat Masuk
    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    // Relasi ke Surat Keluar
    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}
