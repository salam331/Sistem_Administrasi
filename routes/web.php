<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Controller untuk Admin
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\RaportController;
use App\Http\Controllers\Admin\SuratKeluarController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Siswa\TagihanController as SiswaTagihanController;

// Controller untuk Siswa
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect default ke login
Route::get('/', function () {
    return redirect('/login');
});

// Semua route di bawah ini wajib login
Route::middleware(['auth'])->group(function () {

    // === Dashboard Umum (akan redirect otomatis sesuai role) ===
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // === ROUTE ADMIN ===
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        // CRUD Data Pengguna
        Route::resource('users', UserController::class);
        Route::get('users/role/{role}', [UserController::class, 'showRole'])->name('users.role');

        // CRUD Guru, Siswa, Kelas, Mapel
        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
        Route::resource('mapel', MapelController::class);

        // Jadwal, Presensi, Nilai
        Route::resource('jadwal', JadwalController::class);
        Route::get('presensi/show', [PresensiController::class, 'show'])->name('presensi.show');
        Route::get('presensi/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
        Route::put('presensi/update', [PresensiController::class, 'update'])->name('presensi.update');
        Route::resource('presensi', PresensiController::class)->except(['show', 'edit', 'update']);
        Route::resource('nilai', NilaiController::class);

        // Raport
        Route::get('raport', [RaportController::class, 'index'])->name('raport.index');
        Route::get('raport/lihat', [RaportController::class, 'lihat'])->name('raport.lihat');
        Route::get('raport/cetak', [RaportController::class, 'cetak'])->name('raport.cetak');

        // Surat Keluar
        Route::resource('surat-keluar', SuratKeluarController::class);
        Route::get('surat-keluar/{suratKeluar}/lihat', [SuratKeluarController::class, 'lihat'])->name('surat-keluar.lihat');
        Route::get('surat-keluar/{suratKeluar}/cetak', [SuratKeluarController::class, 'cetak'])->name('surat-keluar.cetak');

        // Keuangan
        Route::resource('tagihan', TagihanController::class);
        Route::resource('pembayaran', PembayaranController::class);
    });

    // === ROUTE GURU ===
    Route::middleware(['role:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        // Tambahkan route lain untuk guru di sini
    });

    // === ROUTE SISWA ===
    Route::middleware(['role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [SiswaDashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route lain untuk siswa di sini

        // === ke tagihan siswa ===
        Route::get('/tagihan', [SiswaTagihanController::class, 'index'])->name('tagihan.index');

        // === ke jadwal siswa ===
        Route::get('/jadwal', [SiswaJadwalController::class, 'index'])->name('jadwal.index');
    });

    // === ROUTE PROFILE (bawaan Breeze) ===
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
