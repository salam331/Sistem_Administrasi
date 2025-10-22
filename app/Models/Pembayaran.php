<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'siswa_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_bayar',
        'keterangan',
    ];

    // Satu pembayaran milik SATU tagihan
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    // Satu pembayaran dilakukan oleh SATU siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
