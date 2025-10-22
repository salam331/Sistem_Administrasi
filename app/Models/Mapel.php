<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mapel',
        'alokasi_jam',
    ];

    /**
     * Relasi: Satu Mapel bisa diajar oleh banyak Guru.
     */
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel');
    }

    /**
     * Relasi: Satu Mapel bisa memiliki banyak Jadwal mengajar.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
