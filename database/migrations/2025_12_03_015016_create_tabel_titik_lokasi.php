<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('titik_lokasi', function (Blueprint $table) {
            $table->id('id_titik');
            $table->string('nama_titik');

            // Foreign Keys
            $table->unsignedBigInteger('id_wilayah');
            $table->unsignedBigInteger('id_kec_kel');
            $table->unsignedBigInteger('id_klasifikasi');
            $table->unsignedBigInteger('id_koneksi');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_backbone');
            $table->unsignedBigInteger('id_uplink');
            $table->unsignedBigInteger('id_perangkat');

            // Text fields
            $table->text('keterangan')->nullable();
            $table->text('rencana_pengembangan')->nullable();

            // Location fields
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();

            // Timestamps
            $table->timestamps();

            // Foreign Key Relations
            $table->foreign('id_wilayah')->references('id')->on('wilayah')->onDelete('cascade');
            $table->foreign('id_kec_kel')->references('id')->on('kec_kel')->onDelete('cascade');
            $table->foreign('id_klasifikasi')->references('id')->on('klasifikasi')->onDelete('cascade');
            $table->foreign('id_koneksi')->references('id')->on('koneksi')->onDelete('cascade');
            $table->foreign('id_status')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('id_backbone')->references('id')->on('backbone')->onDelete('cascade');
            $table->foreign('id_uplink')->references('id')->on('uplink')->onDelete('cascade');
            $table->foreign('id_perangkat')->references('id')->on('perangkat')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('titik_lokasi');
    }
};
