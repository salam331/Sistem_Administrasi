<?php

namespace App\Models;

// Impor yang dibutuhkan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// IMPOR WAJIB UNTUK API & ROLES
use Laravel\Sanctum\HasApiTokens;       // <-- Ini yang hilang sebelumnya
use Spatie\Permission\Traits\HasRoles;  // <-- Ini yang hilang sebelumnya

// Impor model lain yang direlasikan
use App\Models\Guru;
use App\Models\Siswa;
// (Role diimpor otomatis oleh Spatie, tidak perlu 'use App\Models\Role;')

class User extends Authenticatable
{
    // Gunakan trait yang diperlukan (termasuk HasApiTokens dan HasRoles)
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Fungsi role() lama sudah kita hapus (Ini sudah benar)

    /**
     * Relasi: Satu User (jika rolenya guru) memiliki satu data Guru.
     */
    public function guru()
    {
        // 'user_id' adalah foreign key di tabel 'gurus'
        return $this->hasOne(Guru::class, 'user_id');
    }

    /**
     * Relasi: Satu User (jika rolenya siswa) memiliki satu data Siswa.
     */
    public function siswa()
    {
        // 'user_id' adalah foreign key di tabel 'siswas'
        return $this->hasOne(Siswa::class, 'user_id');
    }
}