<?php

// database/migrations/..._create_gurus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();

            // Relasi One-to-One ke tabel users
            $table->foreignId('user_id')
                  ->constrained('users') // terhubung ke tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, data guru ikut terhapus

            $table->string('nip', 20)->unique(); // Nomor Induk Pegawai
            $table->string('jabatan'); // mis: Guru Mapel, Wali Kelas, Kepala Sekolah
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};