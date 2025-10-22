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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            // Relasi ke Kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->onDelete('cascade'); // Jika kelas dihapus, jadwalnya ikut terhapus

            // Relasi ke Mapel
            $table->foreignId('mapel_id')
                ->constrained('mapels')
                ->onDelete('cascade'); // Jika mapel dihapus, jadwalnya ikut terhapus

            // Relasi ke Guru Pengampu
            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->onDelete('cascade'); // Jika guru dihapus, jadwalnya ikut terhapus

            // Kolom Waktu
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
