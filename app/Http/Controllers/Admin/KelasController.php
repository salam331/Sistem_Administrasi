<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar semua kelas. (INI YANG BARU)
     */
    public function index()
    {
        // 1. Ambil semua data kelas
        // 'with('waliKelas', 'waliKelas.user')'
        //  - 'waliKelas': Ambil data guru yang jadi wali kelas
        //  - 'waliKelas.user': Ambil data user (nama) dari guru tersebut
        $kelases = Kelas::with('waliKelas.user')->orderBy('tingkat', 'asc')->get();

        // 2. Kirim data ke view
        return view('admin.kelas.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data guru untuk dropdown Wali Kelas
        // Kita hanya ambil guru yang BELUM menjadi wali kelas
        $gurus = Guru::with('user')
            ->whereDoesntHave('kelasWali') // Cek relasi 'kelasWali'
            ->get();

        return view('admin.kelas.create', compact('gurus'));
    }

    /**
     * Menyimpan kelas baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas',
            'tingkat' => 'required|integer|min:10|max:12',
            'guru_id' => 'nullable|exists:gurus,id|unique:kelas,guru_id',
        ]);

        // 2. Buat data
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'guru_id' => $request->guru_id,
        ]);

        // 3. Redirect
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        // Load relasi wali kelas dan siswa
        $kelas->load(['waliKelas.user', 'siswas.user']);

        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        // Load relasi wali kelas
        $kelas->load('waliKelas.user');

        // Ambil data guru untuk dropdown Wali Kelas
        // Guru yang sudah jadi wali kelas ini, atau guru yang belum jadi wali kelas
        $gurus = Guru::with('user')
            ->where(function($query) use ($kelas) {
                $query->whereDoesntHave('kelasWali') // Guru yang belum jadi wali kelas
                      ->orWhere('id', $kelas->guru_id); // Atau guru yang sudah jadi wali kelas ini
            })
            ->get();

        return view('admin.kelas.edit', compact('kelas', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        // 1. Validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $kelas->id,
            'tingkat' => 'required|integer|min:10|max:12',
            'guru_id' => 'nullable|exists:gurus,id|unique:kelas,guru_id,' . $kelas->id,
        ]);

        // 2. Update data
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'guru_id' => $request->guru_id,
        ]);

        // 3. Redirect
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        // Cek apakah kelas masih memiliki siswa
        if ($kelas->siswas()->count() > 0) {
            return back()->withErrors('Kelas ini masih memiliki siswa. Pindahkan siswa ke kelas lain terlebih dahulu.');
        }

        // Hapus data kelas
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
