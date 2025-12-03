<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->increments('stok_id'); // PK

            // Foreign key
            $table->unsignedInteger('barang_id'); // FK ke tabel_barang

            $table->string('satuan');
            $table->string('kuantitas');
            $table->string('terpakai')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('sisa')->nullable();

            $table->timestamps();

            // FK Constraint
            $table->foreign('barang_id')
                ->references('barang_id')->on('tabel_barang')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_barang');
    }
};
