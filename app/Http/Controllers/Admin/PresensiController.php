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
     * Get mata pelajaran berdasarkan kelas_id via AJAX
     */
    public function getMapel($kelasId)
    {
        $mapels = Jadwal::where('kelas_id', $kelasId)
            ->with('mapel')
            ->get()
            ->pluck('mapel')
            ->unique('id')
            ->values();

        return response()->json($mapels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validasi input dari form sebelumnya
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tanggal' => 'required|date',
        ]);

        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');
        $tanggal = $request->input('tanggal');

        // Ambil data kelas, siswa, dan guru wali kelas
        $kelas = Kelas::with(['siswas.user', 'waliKelas.user'])->findOrFail($kelasId);

        // Ambil jadwal berdasarkan kelas dan mapel
        $jadwal = Jadwal::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->with('mapel', 'guru.user')
            ->firstOrFail();

        return view('admin.presensi.create', compact('kelas', 'jadwal', 'tanggal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tanggal' => 'required|date',
            'status' => 'required|array', // Pastikan status adalah array
            'status.*' => 'required|in:Hadir,Izin,Sakit,Alpha', // Validasi setiap item di array
        ]);

        $tanggal = $request->input('tanggal');
        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');

        // Ambil jadwal_id berdasarkan kelas dan mapel
        $jadwal = Jadwal::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->firstOrFail();

        // Loop melalui setiap status siswa yang dikirim dari form
        foreach ($request->status as $siswaId => $status) {
            // updateOrCreate akan meng-update jika sudah ada, atau membuat baru jika belum ada
            // Ini mencegah data absensi duplikat pada hari yang sama untuk siswa yang sama
            Presensi::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'siswa_id' => $siswaId,
                    'jadwal_id' => $jadwal->id,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.presensi.show', ['kelas_id' => $kelasId, 'mapel_id' => $mapelId, 'tanggal' => $tanggal])
            ->with('success', 'Data presensi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tanggal' => 'required|date',
        ]);

        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');
        $tanggal = $request->input('tanggal');

        $kelas = Kelas::with(['siswas.user', 'waliKelas.user'])->findOrFail($kelasId);

        // Ambil jadwal berdasarkan kelas dan mapel
        $jadwal = Jadwal::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->with('mapel', 'guru.user')
            ->firstOrFail();

        // Ambil data presensi untuk jadwal dan tanggal tertentu
        $presensis = Presensi::where('tanggal', $tanggal)
            ->where('jadwal_id', $jadwal->id)
            ->whereHas('siswa', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->with('siswa.user')
            ->get()
            ->keyBy('siswa_id');

        return view('admin.presensi.show', compact('kelas', 'jadwal', 'tanggal', 'presensis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tanggal' => 'required|date',
        ]);

        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');
        $tanggal = $request->input('tanggal');

        $kelas = Kelas::with(['siswas.user', 'waliKelas.user'])->findOrFail($kelasId);

        // Ambil jadwal berdasarkan kelas dan mapel
        $jadwal = Jadwal::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->with('mapel', 'guru.user')
            ->firstOrFail();

        // Ambil data presensi untuk jadwal dan tanggal tertentu
        $presensis = Presensi::where('tanggal', $tanggal)
            ->where('jadwal_id', $jadwal->id)
            ->whereHas('siswa', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->with('siswa.user')
            ->get()
            ->keyBy('siswa_id');

        return view('admin.presensi.edit', compact('kelas', 'jadwal', 'tanggal', 'presensis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'tanggal' => 'required|date',
            'status' => 'required|array',
            'status.*' => 'required|in:Hadir,Izin,Sakit,Alpha',
        ]);

        $tanggal = $request->input('tanggal');
        $kelasId = $request->input('kelas_id');
        $mapelId = $request->input('mapel_id');

        // Ambil jadwal_id berdasarkan kelas dan mapel
        $jadwal = Jadwal::where('kelas_id', $kelasId)
            ->where('mapel_id', $mapelId)
            ->firstOrFail();

        // Loop melalui setiap status siswa yang dikirim dari form
        foreach ($request->status as $siswaId => $status) {
            Presensi::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'siswa_id' => $siswaId,
                    'jadwal_id' => $jadwal->id,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.presensi.show', ['kelas_id' => $kelasId, 'mapel_id' => $mapelId, 'tanggal' => $tanggal])
            ->with('success', 'Data presensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
