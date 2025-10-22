<?php

// database/migrations/..._create_siswas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            // Relasi One-to-One ke tabel users
            $table->foreignId('user_id')
                ->constrained('users') // terhubung ke tabel 'users'
                ->onDelete('cascade'); // Jika user dihapus, data siswa ikut terhapus

            $table->string('nis', 20)->unique(); // Nomor Induk Siswa
            $table->text('alamat')->nullable();
            $table->string('nama_wali')->nullable();
            $table->enum('status', ['Aktif', 'Lulus', 'Keluar', 'Pindah'])
                ->default('Aktif');

            // Nanti kita akan tambah 'kelas_id' di Tahap 2.3

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
