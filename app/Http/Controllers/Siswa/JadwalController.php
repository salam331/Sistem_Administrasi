<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Menampilkan jadwal pelajaran siswa yang sedang login.
     */
    public function index()
    {
        // 1. Ambil ID kelas siswa yang sedang login
        $kelasId = Auth::user()->siswa->kelas_id;

        // 2. Ambil jadwal berdasarkan kelas siswa
        $jadwals = Jadwal::with(['mapel', 'guru.user'])
            ->where('kelas_id', $kelasId)
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 3. Tampilkan view
        return view('siswa.jadwal.index', compact('jadwals'));
    }
}
