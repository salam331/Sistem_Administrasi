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
        Schema::table('siswas', function (Blueprint $table) {
            //
            // Tambahkan kolom 'kelas_id' setelah 'status'
            $table->foreignId('kelas_id')
                ->nullable() // Siswa baru mungkin belum dapat kelas
                ->after('status')
                ->constrained('kelas') // Terhubung ke tabel 'kelas'
                ->onDelete('set null'); // Jika kelas dihapus, 'kelas_id' siswa jadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            //
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
