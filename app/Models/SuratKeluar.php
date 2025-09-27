<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $fillable = [
        'nomor_surat',
        'penerima',
        'tanggal_surat',
        'perihal_id',
        'user_id',
        'tujuan_id',
        'file',
        'status',
        'admin_approval',
        'korwil_approval'
    ];

    public function perihal()
    {
        return $this->belongsTo(Perihal::class);
    }

    // Relasi ke User (yang buat surat)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}