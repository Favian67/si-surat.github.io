<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tanggal_surat',
        'perihal_id',
        'user_id',
        'file'
    ];  

    // Relasi ke Perihal
    public function perihal()
    {
        return $this->belongsTo(Perihal::class);
    }

    // Relasi ke User (yang input surat)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
