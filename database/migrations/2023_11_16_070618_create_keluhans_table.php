<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateKeluhansTable extends Migration
{
    public function up()
    {
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Ditolak', 'Proses', 'Selesai'])->default('Proses');
            $table->date('tanggal_pelaporan');
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedBigInteger('penyewa_id');
            $table->foreign('penyewa_id')->references('id')->on('penyewas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keluhans');
    }
}
