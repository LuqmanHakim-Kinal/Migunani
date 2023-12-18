<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyewa_id')->nullable()->constrained('penyewas'); // Assuming you have a penyewas table
            $table->string('status_bayar')->default('Belum Bayar')->nullable();
            $table->string('nama_pembayar')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->date('batas_bayar')->nullable();
            $table->date('jumlah_bulan')->nullable();
            $table->decimal('harga', 12, 2)->nullable();
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
