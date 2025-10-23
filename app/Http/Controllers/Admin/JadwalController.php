<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal. (INI YANG BARU)
     */
    public function index()
    {
        // 1. Ambil semua data jadwal
        // Kita gunakan 'with' untuk eager loading relasinya
        // 'kelas' -> ambil data kelas
        // 'mapel' -> ambil data mapel
        // 'guru.user' -> ambil data guru DAN data user (nama) guru tsb
        $jadwals = Jadwal::with(['kelas', 'mapel', 'guru.user'])
            ->orderBy('kelas_id', 'asc') // Urutkan berdasarkan kelas
            ->orderBy('hari', 'asc')      // Lalu urutkan berdasarkan hari
            ->orderBy('jam_mulai', 'asc') // Lalu urutkan berdasarkan jam
            ->get();

        // 2. Kirim data ke view
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        // Ambil semua data master untuk dropdown
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();
        $gurus = Guru::with('user')->get()->sortBy('user.name'); // Urutkan berdasarkan nama user

        return view('admin.jadwal.create', compact('kelases', 'mapels', 'gurus'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // 2. Buat data
        Jadwal::create($request->all());

        // 3. Redirect
        return redirect()->route('admin.jadwal.index')->with('success', 'Entri jadwal berhasil ditambahkan.');
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        // Ambil semua data master untuk dropdown
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();
        $gurus = Guru::with('user')->get()->sortBy('user.name'); // Urutkan berdasarkan nama user

        return view('admin.jadwal.edit', compact('jadwal', 'kelases', 'mapels', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        // 1. Validasi
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // 2. Update data
        $jadwal->update($request->all());

        // 3. Redirect
        return redirect()->route('admin.jadwal.index')->with('success', 'Entri jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Entri jadwal berhasil dihapus.');
    }
}
