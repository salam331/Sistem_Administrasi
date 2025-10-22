<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'alamat',
        'nama_wali',
        'status',
        'kelas_id',
    ];

    /**
     * Relasi sebaliknya: Satu Siswa HANYA dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu Siswa milik satu Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Seorang siswa bisa punya BANYAK tagihan
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }

    // Seorang siswa bisa punya BANYAK histori pembayaran
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
