<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'jenis_tagihan',
        'deskripsi',
        'jumlah_tagihan',
        'tanggal_tagihan',
        'tanggal_jatuh_tempo',
        'status',
    ];

    // Satu tagihan dimiliki oleh SATU siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Satu tagihan bisa punya BANYAK pembayaran (jika dicicil)
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
