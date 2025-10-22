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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            // Siswa yang diabsen
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            // Jadwal pelajaran spesifik saat absen (opsional)
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwals')->onDelete('set null');

            // Status absensi
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha']);

            // Keterangan (opsional)
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
