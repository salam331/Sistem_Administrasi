<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    /**
     * Relasi: Satu entri jadwal milik satu Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relasi: Satu entri jadwal untuk satu Mapel
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    /**
     * Relasi: Satu entri jadwal diajar oleh satu Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }
}