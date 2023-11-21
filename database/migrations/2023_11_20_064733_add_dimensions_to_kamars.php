<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsToKamars extends Migration
{
    public function up()
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->decimal('panjang_kamar')->nullable();
            $table->decimal('lebar_kamar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->dropColumn(['panjang_kamar', 'lebar_kamar']);
        });
    }
}