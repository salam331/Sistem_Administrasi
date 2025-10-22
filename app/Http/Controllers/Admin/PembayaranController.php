<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk transaksi database
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayarans = Pembayaran::with(['siswa.user', 'tagihan'])
            ->orderBy('tanggal_bayar', 'desc')
            ->paginate(20);

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Menampilkan form untuk input pembayaran baru.
     * (Ini untuk link "Bayar" dari halaman tagihan)
     */
    public function create(Request $request)
    {
        // 1. Ambil tagihan_id dari URL
        $tagihan_id = $request->query('tagihan_id');
        if (!$tagihan_id) {
            return redirect()->route('admin.tagihan.index')->withErrors('Tagihan tidak ditemukan.');
        }

        // 2. Cari tagihan beserta relasinya
        $tagihan = Tagihan::with(['siswa.user', 'pembayarans'])->findOrFail($tagihan_id);

        // 3. Hitung sisa tagihan
        $total_dibayar = $tagihan->pembayarans->sum('jumlah_bayar');
        $sisa_tagihan = $tagihan->jumlah_tagihan - $total_dibayar;

        return view('admin.pembayaran.create', compact('tagihan', 'sisa_tagihan'));
    }

    /**
     * Menyimpan pembayaran baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'siswa_id' => 'required|exists:siswas,id',
            'jumlah_bayar' => 'required|numeric|min:1',
            'tanggal_bayar' => 'required|date',
            'metode_bayar' => 'required|string',
        ]);

        // Gunakan DB Transaction untuk memastikan data konsisten
        // Jika salah satu gagal, semua akan dibatalkan
        try {
            DB::transaction(function () use ($request) {

                // 1. Kunci tagihan agar tidak ada duplikasi pembayaran
                $tagihan = Tagihan::with('pembayarans')
                    ->where('id', $request->tagihan_id)
                    ->lockForUpdate() // PENTING!
                    ->first();

                // 2. Hitung sisa tagihan
                $total_dibayar = $tagihan->pembayarans->sum('jumlah_bayar');
                $sisa_tagihan = $tagihan->jumlah_tagihan - $total_dibayar;

                // 3. Cek apakah pembayaran melebihi sisa tagihan
                if ($request->jumlah_bayar > $sisa_tagihan) {
                    // Gunakan 'throw' untuk membatalkan transaksi
                    throw new \Exception('Jumlah bayar tidak boleh melebihi sisa tagihan.');
                }

                // 4. Simpan data pembayaran
                $pembayaran = Pembayaran::create([
                    'tagihan_id' => $request->tagihan_id,
                    'siswa_id' => $request->siswa_id,
                    'tanggal_bayar' => $request->tanggal_bayar,
                    'jumlah_bayar' => $request->jumlah_bayar,
                    'metode_bayar' => $request->metode_bayar,
                    'keterangan' => $request->keterangan,
                ]);

                // 5. Update status tagihan
                $total_dibayar_baru = $total_dibayar + $request->jumlah_bayar;

                if ($total_dibayar_baru >= $tagihan->jumlah_tagihan) {
                    $tagihan->status = 'Lunas';
                } else {
                    $tagihan->status = 'Sebagian';
                }
                $tagihan->save();

                // Simpan ID pembayaran baru ke session untuk redirect
                session()->put('last_pembayaran_id', $pembayaran->id);
            });

        } catch (\Exception $e) {
            // Jika transaksi gagal, kembali dengan error
            return back()->withInput()->withErrors(['jumlah_bayar' => $e->getMessage()]);
        }

        // 6. Redirect ke halaman Kwitansi (method show())
        $last_pembayaran_id = session()->pull('last_pembayaran_id');
        return redirect()->route('admin.pembayaran.show', $last_pembayaran_id)
            ->with('success', 'Pembayaran berhasil disimpan!');
    }

    /**
     * Menampilkan Kwitansi Digital (PDF).
     */
    public function show(Pembayaran $pembayaran)
    {
        // $pembayaran otomatis diambil dari ID di URL
        // Load relasi yang dibutuhkan untuk kwitansi
        $pembayaran->load(['tagihan.siswa.user', 'tagihan.siswa.kelas']);

        $data = [
            'pembayaran' => $pembayaran,
        ];

        // Buat nama file PDF
        $namaFile = 'kwitansi-' . $pembayaran->id . '-' . $pembayaran->siswa->user->name . '.pdf';

        // Load view kwitansi dan kirim data
        $pdf = Pdf::loadView('admin.pembayaran.kwitansi', $data);

        // Tampilkan PDF di browser
        return $pdf->stream($namaFile);
    }
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
