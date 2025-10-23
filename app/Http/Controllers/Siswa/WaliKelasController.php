<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    /**
     * Menampilkan detail informasi wali kelas siswa yang sedang login.
     */
    public function show()
    {
        // 1. Ambil data siswa yang sedang login
        $user = Auth::user();
        $siswa = $user->siswa;

        // 2. Ambil data wali kelas melalui relasi kelas
        $waliKelas = $siswa->kelas->waliKelas ?? null;

        // 3. Jika tidak ada wali kelas, redirect dengan pesan
        if (!$waliKelas) {
            return redirect()->route('siswa.dashboard')->with('error', 'Wali kelas belum ditentukan untuk kelas Anda.');
        }

        // 4. Load relasi user untuk mendapatkan data lengkap guru
        $waliKelas->load('user');

        // 5. Tampilkan view detail wali kelas
        return view('siswa.wali-kelas.show', compact('waliKelas', 'siswa'));
    }
}
