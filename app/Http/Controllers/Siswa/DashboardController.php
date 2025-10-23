<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data siswa yang sedang login
        $user = Auth::user();
        $siswa = $user->siswa;

        // 2. Ambil data wali kelas
        $waliKelas = $siswa->kelas->waliKelas ?? null;

        // 3. Hitung jumlah tagihan belum lunas
        $jumlahTagihanBelumLunas = $siswa->tagihans()->where('status', 'Belum Lunas')->count();

        // 4. Kirim data ke view
        return view('siswa.dashboard', compact('user', 'siswa', 'waliKelas', 'jumlahTagihanBelumLunas'));
    }
}