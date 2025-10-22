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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            // Pembayaran ini untuk tagihan yang mana
            $table->foreignId('tagihan_id')->constrained('tagihans')->onDelete('cascade');

            // Siswa yang membayar (untuk memudahkan query)
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            $table->date('tanggal_bayar');
            $table->decimal('jumlah_bayar', 15, 2); // Jumlah yang dibayarkan saat itu
            $table->string('metode_bayar'); // Mis: 'Tunai', 'Transfer Bank'
            $table->string('keterangan')->nullable(); // Mis: 'Bayar lunas', 'Cicilan ke-1'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
