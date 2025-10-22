<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'guru_id',
    ];

    /**
     * Relasi: Satu Kelas punya satu Wali Kelas (Guru)
     */
    public function waliKelas()
    {
        // 'guru_id' adalah foreign key di tabel ini
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relasi: Satu Kelas punya banyak Siswa
     */
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    /**
     * Relasi: Satu Kelas punya banyak Jadwal
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
