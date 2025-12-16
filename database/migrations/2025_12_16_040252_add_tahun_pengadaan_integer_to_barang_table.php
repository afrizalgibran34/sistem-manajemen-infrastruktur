<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('stok_barang', function (Blueprint $table) {
            $table->string('foto')->nullable();
            $table->string('kondisi')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->integer('tahun_pengadaan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stok_barang', function (Blueprint $table) {
            $table->dropColumn(['foto','kondisi','spesifikasi','tahun_pengadaan']);
        });
    }

};
