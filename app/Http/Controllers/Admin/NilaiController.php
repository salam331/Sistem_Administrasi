<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases = Kelas::orderBy('nama_kelas')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('admin.nilai.index', compact('kelases', 'mapels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'jenis_nilai' => 'required|in:Tugas,Harian,UTS,UAS',
        ]);

        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');
        $jenisNilai = $request->input('jenis_nilai');

        // Ambil data
        $kelas = Kelas::with('siswas.user')->findOrFail($kelasId);
        $mapel = Mapel::findOrFail($mapelId);

        // Ambil nilai yang sudah ada (jika ada) untuk ditampilkan di form
        $nilaiSudahAda = Nilai::where('mapel_id', $mapelId)
            ->where('jenis_nilai', $jenisNilai)
            ->whereIn('siswa_id', $kelas->siswas->pluck('id'))
            ->pluck('nilai', 'siswa_id'); // [siswa_id => nilai]

        return view('admin.nilai.create', compact('kelas', 'mapel', 'jenisNilai', 'nilaiSudahAda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'jenis_nilai' => 'required|in:Tugas,Harian,UTS,UAS',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        $mapelId = $request->input('mapel_id');
        $jenisNilai = $request->input('jenis_nilai');
        // Asumsi semester dan tahun ajaran masih default
        $tahunAjaran = '2024/2025';
        $semester = 'Ganjil';

        foreach ($request->nilai as $siswaId => $nilaiAngka) {
            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'mapel_id' => $mapelId,
                    'jenis_nilai' => $jenisNilai,
                    'tahun_ajaran' => $tahunAjaran,
                    'semester' => $semester,
                ],
                [
                    'nilai' => $nilaiAngka,
                ]
            );
        }

        return redirect()->route('admin.nilai.index')->with('success', 'Data nilai berhasil disimpan.');
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
