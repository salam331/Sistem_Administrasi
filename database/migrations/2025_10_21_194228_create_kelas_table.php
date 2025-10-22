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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas')->unique(); // Mis: "X IPA 1", "XI IPS 2"
            $table->integer('tingkat'); // Mis: 10, 11, 12

            // Relasi ke Wali Kelas (dari tabel gurus)
            $table->foreignId('guru_id')
                ->nullable() // Boleh kosong (belum ada wali kelas)
                ->unique() // Satu guru hanya bisa jadi wali di satu kelas
                ->constrained('gurus') // Terhubung ke tabel 'gurus'
                ->onDelete('set null'); // Jika guru dihapus, wali kelas jadi NULL

            // Relasi ke Siswa (dari tabel siswas)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
