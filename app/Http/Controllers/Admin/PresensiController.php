<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases = Kelas::orderBy('nama_kelas')->get();
        return view('admin.presensi.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validasi input dari form sebelumnya
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
        ]);

        $kelasId = $request->input('kelas_id');
        $tanggal = $request->input('tanggal');

        // Ambil data kelas dan daftar siswanya
        $kelas = Kelas::with('siswas.user')->findOrFail($kelasId);

        // Nanti bisa ditambahkan pengambilan jadwal spesifik pada hari itu
        // Untuk sekarang, kita fokus pada absensi harian per kelas

        return view('admin.presensi.create', compact('kelas', 'tanggal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal' => 'required|date',
            'status' => 'required|array', // Pastikan status adalah array
            'status.*' => 'required|in:Hadir,Izin,Sakit,Alpha', // Validasi setiap item di array
        ]);

        $tanggal = $request->input('tanggal');

        // Loop melalui setiap status siswa yang dikirim dari form
        foreach ($request->status as $siswaId => $status) {
            // updateOrCreate akan meng-update jika sudah ada, atau membuat baru jika belum ada
            // Ini mencegah data absensi duplikat pada hari yang sama untuk siswa yang sama
            Presensi::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'siswa_id' => $siswaId,
                ],
                [
                    'status' => $status,
                    // 'jadwal_id' bisa ditambahkan di sini jika ada
                ]
            );
        }

        return redirect()->route('admin.presensi.index')->with('success', 'Data presensi berhasil disimpan.');
    }

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
