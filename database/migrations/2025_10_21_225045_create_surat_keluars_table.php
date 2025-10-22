<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id();
            // Kolom untuk Nomor Surat Otomatis
            $table->string('nomor_surat')->unique(); // Mis: 001/SMAN1/X/2025

            $table->date('tanggal_surat');
            $table->string('jenis_surat'); // Mis: Keterangan Aktif, Izin, Undangan
            $table->string('perihal');

            // Relasi ke data lain (opsional)
            $table->foreignId('siswa_id')->nullable()->constrained('siswas')->onDelete('set null');
            // $table->foreignId('guru_id')->nullable()... (jika ada surat tugas guru)

            // Penyimpanan file (jika kita juga mengarsip file upload-an)
            // $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
