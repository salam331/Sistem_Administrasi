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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            // Siswa yang memiliki tagihan ini
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            $table->string('jenis_tagihan'); // Mis: 'SPP', 'Buku', 'Studi Tur'
            $table->string('deskripsi'); // Mis: 'SPP Bulan Oktober 2025'
            $table->decimal('jumlah_tagihan', 15, 2); // Jumlah total yang harus dibayar

            $table->date('tanggal_tagihan');
            $table->date('tanggal_jatuh_tempo')->nullable();

            // Status untuk melacak pembayaran
            $table->enum('status', ['Belum Lunas', 'Lunas', 'Sebagian']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
