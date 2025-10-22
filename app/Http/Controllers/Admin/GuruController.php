<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data guru
        // 'with('user')' adalah Eager Loading untuk mengambil data relasi
        // dari tabel 'users' (seperti nama dan email)
        $gurus = Guru::with('user')->orderBy('created_at', 'desc')->get();

        // 2. Kirim data ke view
        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.guru.create');
    }

    /**
     * Menyimpan guru baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nip' => 'required|string|max:20|unique:gurus',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // 2. Cari Role 'guru'
        $guruRole = Role::where('name', 'guru')->first();
        if (!$guruRole) {
            // Handle jika role 'guru' tidak ditemukan
            return back()->withErrors('Role "guru" tidak ditemukan. Silakan buat role tersebut terlebih dahulu.');
        }

        // 3. Buat data User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 4. Assign role menggunakan Spatie Permission
        $user->assignRole('guru');

        // 5. Buat data Guru yang terhubung dengan User
        $user->guru()->create([
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
        ]);

        // 5. Redirect ke halaman index guru
        // Kita akan buat halaman index ini nanti
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        // Load relasi user dan kelas wali (jika ada)
        $guru->load(['user', 'kelasWali']);

        return view('admin.guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        // Load relasi user
        $guru->load('user');

        return view('admin.guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $guru->user_id,
            'nip' => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // 2. Update data User
        $guru->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // 3. Update data Guru
        $guru->update([
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
        ]);

        // 4. Redirect
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        // Cek apakah guru masih menjadi wali kelas
        if ($guru->kelasWali) {
            return back()->withErrors('Guru ini masih menjadi wali kelas. Hapus relasi wali kelas terlebih dahulu.');
        }

        // Hapus data guru (akan otomatis hapus user karena cascade)
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
