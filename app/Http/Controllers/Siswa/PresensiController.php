<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;

class PresensiController extends Controller
{
    /**
     * Menampilkan presensi siswa yang sedang login.
     */
    public function index()
    {
        // 1. Ambil ID siswa yang sedang login
        $siswaId = Auth::user()->siswa->id;

        // 2. Ambil data presensi siswa
        $presensis = Presensi::with(['jadwal.mapel', 'jadwal.guru.user'])
            ->where('siswa_id', $siswaId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Tampilkan view
        return view('siswa.presensi.index', compact('presensis'));
    }
}
