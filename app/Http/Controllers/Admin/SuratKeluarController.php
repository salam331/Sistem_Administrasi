<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
{
    /**
     * Halaman Index (Arsip Digital): Menampilkan tabel arsip surat.
     */
    public function index()
    {
        // Ambil semua surat, urutkan dari yang terbaru
        // 'with('siswa.user')' -> ambil data siswa DAN nama user-nya
        $surats = SuratKeluar::with('siswa.user')
            ->orderBy('tanggal_surat', 'desc')
            ->get();

        // Kirim data ke view index
        return view('admin.surat.index', compact('surats'));
    }

    /**
     * Helper function untuk generate nomor surat otomatis
     */

    /**
     * Helper function untuk generate nomor surat otomatis
     */
    private function generateNomorSurat()
    {
        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        $tahun = Carbon::now()->year;
        $bulan = Carbon::now()->month;
        $bulanRomawi = $bulanRomawi[$bulan];

        $lastSurat = SuratKeluar::whereYear('tanggal_surat', $tahun)->orderBy('id', 'desc')->first();

        $nomorUrut = 1;
        if ($lastSurat) {
            $parts = explode('/', $lastSurat->nomor_surat);
            $nomorUrut = (int) $parts[0] + 1;
        }

        $nomorBaru = sprintf('%03d', $nomorUrut) . '/SMAN1/' . $bulanRomawi . '/' . $tahun;

        return $nomorBaru;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::with('user')->get()->sortBy('user.name');
        return view('admin.surat.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string',
            'perihal' => 'required|string',
            'tanggal_surat' => 'required|date',
            'siswa_id' => 'nullable|exists:siswas,id',
        ]);

        $nomorSurat = $this->generateNomorSurat();

        SuratKeluar::create([
            'nomor_surat' => $nomorSurat,
            'jenis_surat' => $request->jenis_surat,
            'perihal' => $request->perihal,
            'tanggal_surat' => $request->tanggal_surat,
            'siswa_id' => $request->siswa_id,
        ]);

        return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat berhasil diarsipkan dengan nomor: ' . $nomorSurat);
    }

    /**
     * Helper function untuk mengambil data dan memilih template
     */
    private function getSuratData(SuratKeluar $suratKeluar)
    {
        // Load relasi yang dibutuhkan
        $suratKeluar->load(['siswa.user', 'siswa.kelas']);

        $templateView = '';
        if ($suratKeluar->jenis_surat == 'Keterangan Siswa Aktif') {
            // UBAH DI SINI: Path menunjuk langsung ke 'admin.surat.siswa-aktif'
            $templateView = 'admin.surat.siswa-aktif';
        }
        else if ($suratKeluar->jenis_surat == 'Izin Kunjungan') {
            $templateView = 'admin.surat.izin-kunjungan';
        }
        else if ($suratKeluar->jenis_surat == 'Undangan Orang Tua') {
            $templateView = 'admin.surat.undangan-ortu';
        }
        // else if (jenis_surat lain) { ... }
        else {
            // Jika template tidak ditemukan
            abort(404, 'Template surat untuk jenis ini tidak ditemukan.');
        }

        $data = [
            'surat' => $suratKeluar,
            'siswa' => $suratKeluar->siswa
        ];

        // Kembalikan path view dan data
        return ['view' => $templateView, 'data' => $data];
    }

    /**
     * FITUR BARU: Menampilkan halaman preview HTML
     */

    public function lihat(SuratKeluar $suratKeluar)
    {
        $info = $this->getSuratData($suratKeluar);

        // Kirim data ke view 'lihat' (wrapper)
        return view('admin.surat.lihat', [
            'surat' => $info['data']['surat'],
            'siswa' => $info['data']['siswa'],
            'template_path' => $info['view'] // Kirim path template-nya
        ]);
    }

    /**
     * FITUR LAMA (DIMODIFIKASI): Generate PDF
     */

    public function cetak(SuratKeluar $suratKeluar)
    {
        $info = $this->getSuratData($suratKeluar);

        // Load view template surat (mis: siswa-aktif.blade.php)
        $pdf = Pdf::loadView($info['view'], $info['data']);

        // Ganti '/' di nomor surat menjadi '-' agar nama file valid
        $nomorSuratAman = str_replace('/', '-', $info['data']['surat']->nomor_surat);
        $namaFileAman = 'surat-' . $nomorSuratAman . '.pdf';

        // Tampilkan PDF di browser
        return $pdf->stream($namaFileAman);
    }

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
