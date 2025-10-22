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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade');

            // Kolom Nilai
            $table->string('tahun_ajaran', 10)->default('2024/2025'); // Contoh, nanti bisa dibuat dinamis
            $table->enum('semester', ['Ganjil', 'Genap'])->default('Ganjil');
            $table->enum('jenis_nilai', ['Tugas', 'Harian', 'UTS', 'UAS']);
            $table->decimal('nilai', 5, 2)->default(0.00); // Nilai bisa koma, mis: 85.50

            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Mencegah duplikasi data:
            // Siswa hanya boleh punya 1 nilai UTS Matematika di semester Ganjil 2024/2025
            $table->unique(['siswa_id', 'mapel_id', 'tahun_ajaran', 'semester', 'jenis_nilai'], 'nilai_unik_constraint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
