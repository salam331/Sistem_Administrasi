<?php

// app/Models/Guru.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'jabatan',
        'status',
    ];

    /**
     * Relasi sebaliknya: Satu Guru HANYA dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu Guru hanya bisa menjadi Wali Kelas di satu Kelas
     */
    public function kelasWali()
    {
        // 'guru_id' adalah foreign key di tabel 'kelas'
        return $this->hasOne(Kelas::class, 'guru_id');
    }

    /**
     * Relasi: Satu Guru bisa mengajar banyak Mapel.
     */
    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel');
    }
    
    /**
     * Relasi: Satu Guru bisa memiliki banyak Jadwal mengajar.
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

}
