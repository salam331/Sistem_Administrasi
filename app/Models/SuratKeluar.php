<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'jenis_surat',
        'perihal',
        'siswa_id',
    ];

    /**
     * Relasi ke Siswa (Opsional tapi bagus)
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
