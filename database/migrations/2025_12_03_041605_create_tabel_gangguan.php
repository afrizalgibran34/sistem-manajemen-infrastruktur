<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gangguan', function (Blueprint $table) {
            $table->increments('id_gangguan'); // Primary Key

            $table->date('tanggal'); // Tanggal kejadian

            // Foreign Keys
            $table->unsignedInteger('id_wilayah');          // ke tabel wilayah
            $table->unsignedInteger('id_perangkat');        // ke tabel perangkat_daerah
            $table->unsignedInteger('id_jenismasalah');     // ke tabel jenis_masalah

            // Data gangguan
            $table->string('fo_wireless');                  // Jenis jaringan FO/Wireless
            $table->text('keterangan')->nullable();         // Deskripsi masalah
            $table->text('penanganan')->nullable();         // Tindakan perbaikan

            // Angka laporan
            $table->integer('jumlah_kunjungan')->default(0);
            $table->integer('komplain_masuk')->default(0);
            $table->integer('masalah_selesai')->default(0);
            $table->integer('masalah_tidak_selesai')->default(0);

            $table->timestamps();

            // Foreign Key Relations
            $table->foreign('id_wilayah')
                ->references('id_wilayah')->on('wilayah')
                ->onDelete('cascade');

            $table->foreign('id_perangkat')
                ->references('id_perangkat')->on('perangkat_daerah')
                ->onDelete('cascade');

            $table->foreign('id_jenismasalah')
                ->references('id_jenismasalah')->on('jenis_masalah')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gangguan');
    }
};
