<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

// (untuk tambah 'use Pdf' nanti di method 'cetak')
class RaportController extends Controller
{
    public function index()
    {
        // Ambil semua siswa untuk dropdown
        $siswas = Siswa::with('user')->get()->sortBy('user.name');

        // Data statis untuk dropdown
        $tahun_ajaran = ['2024/2025']; // Nanti bisa dibuat dinamis
        $semesters = ['Ganjil', 'Genap'];

        return view('admin.raport.index', compact('siswas', 'tahun_ajaran', 'semesters'));
    }

    // (Method 'cetak' akan kita isi di langkah 5)
    public function cetak(Request $request)
    {
        // Panggil helper function untuk mengambil data
        $data = $this->getRaportData($request);

        // Generate PDF
        $pdf = Pdf::loadView('admin.raport.template', $data); // Tetap pakai template PDF
        return $pdf->stream('raport-' . $data['siswa']->user->name . '.pdf');
    }

    private function getRaportData(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        // 2. Ambil Data Dasar
        $siswa = Siswa::with(['user', 'kelas.waliKelas.user'])->findOrFail($request->siswa_id);
        $tahun_ajaran = $request->tahun_ajaran;
        $semester = $request->semester;

        // 3. Ambil Data Nilai & Kalkulasi NAR
        $nilais = Nilai::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran', $tahun_ajaran)
            ->where('semester', $semester)
            ->with('mapel')
            ->get()
            ->groupBy('mapel_id');

        $raport_data = [];
        foreach ($nilais as $mapel_id => $nilai_mapel) {
            $mapel_nama = $nilai_mapel->first()->mapel->nama_mapel;
            $tugas = $nilai_mapel->where('jenis_nilai', 'Tugas')->avg('nilai') ?? 0;
            $harian = $nilai_mapel->where('jenis_nilai', 'Harian')->avg('nilai') ?? 0;
            $uts = $nilai_mapel->where('jenis_nilai', 'UTS')->first()->nilai ?? 0;
            $uas = $nilai_mapel->where('jenis_nilai', 'UAS')->first()->nilai ?? 0;
            $nar = ($tugas * 0.2) + ($harian * 0.2) + ($uts * 0.3) + ($uas * 0.3);

            $raport_data[] = [
                'mapel' => $mapel_nama,
                'tugas' => round($tugas, 2),
                'harian' => round($harian, 2),
                'uts' => round($uts, 2),
                'uas' => round($uas, 2),
                'nar' => round($nar, 2),
                'keterangan' => $nar >= 75 ? 'Tuntas' : 'Belum Tuntas',
            ];
        }

        // 4. Ambil Data Presensi (Absensi)
        $absensi = [
            'sakit' => Presensi::where('siswa_id', $siswa->id)->where('status', 'Sakit')->count(),
            'izin' => Presensi::where('siswa_id', $siswa->id)->where('status', 'Izin')->count(),
            'alpha' => Presensi::where('siswa_id', $siswa->id)->where('status', 'Alpha')->count(),
        ];

        // 5. Kumpulkan semua data
        return compact(
            'siswa',
            'tahun_ajaran',
            'semester',
            'raport_data',
            'absensi'
        );
    }

    /**
     * Method BARU untuk menampilkan Halaman HTML Preview
     */

    public function lihat(Request $request)
    {
        // Panggil helper function untuk mengambil data
        $data = $this->getRaportData($request);

        // Kirim data ke view preview (yang akan kita buat)
        return view('admin.raport.lihat', $data);
    }

    /**
     * Method LAMA (Cetak PDF), sekarang menggunakan helper
     */
}
