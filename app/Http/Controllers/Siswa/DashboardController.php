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
        // 'user' adalah relasi dari model User ke Siswa (yang akan kita buat)
        $user = Auth::user();

        // Nanti kita akan tambahkan data lain seperti:
        // $jumlah_tagihan = $user->siswa->tagihans()->where('status', 'Belum Lunas')->count();
        // $jadwal_hari_ini = ...

        return view('siswa.dashboard'); // 2. Tampilkan view 'siswa/dashboard.blade.php'
    }
}