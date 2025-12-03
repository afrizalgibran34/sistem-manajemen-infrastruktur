<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('titik_lokasi', function (Blueprint $table) {
            $table->increments('id_titik'); // Primary Key
            $table->string('nama_titik');

            // Foreign Keys
            $table->unsignedInteger('id_wilayah');
            $table->unsignedInteger('id_kec_kel');
            $table->unsignedInteger('id_klasifikasi');
            $table->unsignedInteger('id_koneksi');
            $table->unsignedInteger('id_status');
            $table->unsignedInteger('id_backbone');
            $table->unsignedInteger('id_uplink');
            $table->unsignedInteger('id_perangkat');

            // Text fields
            $table->text('keterangan')->nullable();
            $table->text('rencana_pengembangan')->nullable();

            // Coordinates
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_wilayah')
                ->references('id_wilayah')->on('wilayah')
                ->onDelete('cascade');

            $table->foreign('id_kec_kel')
                ->references('id_kec_kel')->on('kec_kel')
                ->onDelete('cascade');

            $table->foreign('id_klasifikasi')
                ->references('id_klasifikasi')->on('klasifikasi')
                ->onDelete('cascade');

            $table->foreign('id_koneksi')
                ->references('id_koneksi')->on('koneksi')
                ->onDelete('cascade');

            $table->foreign('id_status')
                ->references('id_status')->on('status')
                ->onDelete('cascade');

            $table->foreign('id_backbone')
                ->references('id_backbone')->on('backbone')
                ->onDelete('cascade');

            $table->foreign('id_uplink')
                ->references('id_uplink')->on('uplink')
                ->onDelete('cascade');

            $table->foreign('id_perangkat')
                ->references('id_perangkat')->on('perangkat')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('titik_lokasi');
    }
};
