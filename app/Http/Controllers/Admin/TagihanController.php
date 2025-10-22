<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data tagihan
        // 2. 'with()' untuk eager loading (mengambil data relasi siswa, user, & kelas)
        // 3. 'orderBy' untuk mengurutkan dari yang terbaru
        // 4. 'paginate(20)' agar halaman tidak berat jika data banyak
        $tagihans = Tagihan::with(['siswa.user', 'siswa.kelas'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        // 3. Kirim data 'tagihans' ke view
        return view('admin.tagihan.index', compact('tagihans'));
    }

    /**
     * Menampilkan form untuk membuat/generate tagihan baru.
     * (Biarkan method create() Anda seperti sebelumnya)
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua kelas untuk dropdown
        $kelases = Kelas::orderBy('nama_kelas')->get();
        return view('admin.tagihan.create', compact('kelases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'jenis_tagihan' => 'required|string',
            'deskripsi' => 'required|string',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'tanggal_tagihan' => 'required|date',
            'kelas_id' => 'required|array|min:1',
            'kelas_id.*' => 'exists:kelas,id',
        ]);

        // 2. Ambil semua ID siswa
        $siswaIds = Siswa::whereIn('kelas_id', $request->kelas_id)->pluck('id');

        if ($siswaIds->isEmpty()) {
            return back()->withErrors(['kelas_id' => 'Tidak ada siswa yang ditemukan di kelas yang dipilih.']);
        }

        $tagihanData = [];
        $now = now();

        // 3. Siapkan data
        foreach ($siswaIds as $siswaId) {
            $tagihanData[] = [
                'siswa_id' => $siswaId,
                'jenis_tagihan' => $request->jenis_tagihan,
                'deskripsi' => $request->deskripsi,
                'jumlah_tagihan' => $request->jumlah_tagihan,
                'tanggal_tagihan' => $request->tanggal_tagihan,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => 'Belum Lunas',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // 4. Insert data
        Tagihan::insert($tagihanData);

        // 5. UBAH REDIRECT: Arahkan ke halaman index
        $jumlahSiswa = count($tagihanData);
        return redirect()->route('admin.tagihan.index')->with('success', "Berhasil men-generate tagihan untuk $jumlahSiswa siswa.");
    }

    /**
     * Menampilkan daftar semua tagihan.
     * (Akan kita isi di langkah selanjutnya)
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
