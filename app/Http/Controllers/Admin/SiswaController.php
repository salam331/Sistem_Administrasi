<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data siswa
        // 'with('user')' untuk mengambil data relasi (nama, email)
        $siswas = Siswa::with('user')->orderBy('created_at', 'desc')->get();

        // 2. Kirim data ke view
        return view('admin.siswa.index', compact('siswas'));
    }

    /**
     * Menampilkan form untuk menambah siswa baru.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Menyimpan siswa baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nis' => 'required|string|max:20|unique:siswas',
            'alamat' => 'nullable|string',
            'nama_wali' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Lulus,Keluar,Pindah',
        ]);

        // 2. Cari Role 'siswa'
        $siswaRole = Role::where('name', 'siswa')->first();
        if (!$siswaRole) {
            return back()->withErrors('Role "siswa" tidak ditemukan.');
        }

        // 3. Buat data User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 4. Assign role menggunakan Spatie Permission
        $user->assignRole('siswa');

        // 5. Buat data Siswa yang terhubung dengan User
        $user->siswa()->create([
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'nama_wali' => $request->nama_wali,
            'status' => $request->status,
        ]);

        // 6. Redirect ke halaman index siswa
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        // Load relasi user dan kelas
        $siswa->load(['user', 'kelas']);

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        // Load relasi user
        $siswa->load('user');

        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $siswa->user_id,
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'alamat' => 'nullable|string',
            'nama_wali' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Lulus,Keluar,Pindah',
        ]);

        // 2. Update data User
        $siswa->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // 3. Update data Siswa
        $siswa->update([
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'nama_wali' => $request->nama_wali,
            'status' => $request->status,
        ]);

        // 4. Redirect
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        // Cek apakah siswa masih memiliki tagihan yang belum lunas
        $tagihanBelumLunas = $siswa->tagihans()->where('status', '!=', 'Lunas')->count();
        if ($tagihanBelumLunas > 0) {
            return back()->withErrors('Siswa ini masih memiliki tagihan yang belum lunas. Harap lunasi terlebih dahulu.');
        }

        // Hapus data siswa (akan otomatis hapus user karena cascade)
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
