<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_barang', function (Blueprint $table) {
            $table->increments('transaksi_id'); // PK

            $table->string('tanggal'); // Bisa dipakai date jika mau

            // Foreign keys
            $table->unsignedInteger('lokasi_id');  // FK ke tabel_lokasi
            $table->unsignedInteger('barang_id');  // FK ke tabel_barang

            $table->string('jumlah');
            $table->string('keterangan')->nullable();

            $table->timestamps();

            // FK Constraints
            $table->foreign('lokasi_id')
                ->references('lokasi_id')->on('tabel_lokasi')
                ->onDelete('cascade');

            $table->foreign('barang_id')
                ->references('barang_id')->on('tabel_barang')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_barang');
    }
};
