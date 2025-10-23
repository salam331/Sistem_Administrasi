<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Tagihan;

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan milik siswa yang sedang login.
     */
    public function index()
    {
        // 1. Dapatkan ID siswa yang sedang login
        // Kita gunakan relasi user->siswa yang sudah kita buat
        $siswaId = Auth::user()->siswa->id;

        // 2. Cari semua tagihan yang 'siswa_id'-nya cocok
        $tagihans = Tagihan::where('siswa_id', $siswaId)
                           ->orderBy('tanggal_tagihan', 'desc')
                           ->paginate(10); // Paginate agar rapi

        // 3. Tampilkan view dan kirim data tagihan
        return view('siswa.tagihan.index', compact('tagihans'));
    }

    /**
     * Menampilkan detail tagihan dan riwayat pembayaran.
     */
    public function show(Tagihan $tagihan)
    {
        // 1. Pastikan tagihan milik siswa yang sedang login
        if ($tagihan->siswa_id !== Auth::user()->siswa->id) {
            abort(403, 'Unauthorized');
        }

        // 2. Load relasi pembayarans
        $tagihan->load('pembayarans');

        // 3. Tampilkan view detail tagihan
        return view('siswa.tagihan.show', compact('tagihan'));
    }
}