<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RevisiTableGangguan extends Migration
{
    public function up()
    {
        Schema::table('gangguan', function (Blueprint $table) {

            /** ============================
             * 1. HAPUS FOREIGN KEY PERANGKAT (JIKA ADA)
             * ============================ */
            if (Schema::hasColumn('gangguan', 'id_perangkat')) {
                try {
                    $table->dropForeign(['id_perangkat']);
                } catch (\Exception $e) {
                    // abaikan jika FK tidak ada
                }
            }

        });

        Schema::table('gangguan', function (Blueprint $table) {

            /** ============================
             * 2. HAPUS KOLOM TIDAK DIGUNAKAN
             * ============================ */
            if (Schema::hasColumn('gangguan', 'id_perangkat')) {
                $table->dropColumn('id_perangkat');
            }

            if (Schema::hasColumn('gangguan', 'komplain_masuk')) {
                $table->dropColumn('komplain_masuk');
            }

            /** ============================
             * 3. TAMBAHKAN KOLOM BARU
             * ============================ */
            if (!Schema::hasColumn('gangguan', 'id_titik')) {
                $table->unsignedBigInteger('id_titik')->nullable()->after('id_gangguan');
            }

            if (!Schema::hasColumn('gangguan', 'bulan')) {
                $table->string('bulan')->nullable()->after('tanggal');
            }

            if (!Schema::hasColumn('gangguan', 'status_masalah')) {
                $table->enum('status_masalah', ['Selesai', 'Tidak Selesai'])
                      ->default('Tidak Selesai')
                      ->after('penanganan');
            }
        });

        /** ============================
         * 4. TAMBAHKAN FOREIGN KEY TITIK
         * ============================ */
        Schema::table('gangguan', function (Blueprint $table) {
            try {
                $table->foreign('id_titik')
                      ->references('id_titik')
                      ->on('titik_lokasi')
                      ->onDelete('set null');
            } catch (\Exception $e) {
                // Jika FK sudah ada, abaikan error
            }
        });
    }



    public function down()
    {
        Schema::table('gangguan', function (Blueprint $table) {

            /** ============================
             * ROLLBACK: HAPUS FK & KOLOM BARU
             * ============================ */

            try {
                $table->dropForeign(['id_titik']);
            } catch (\Exception $e) {}

            if (Schema::hasColumn('gangguan', 'id_titik')) {
                $table->dropColumn('id_titik');
            }

            if (Schema::hasColumn('gangguan', 'bulan')) {
                $table->dropColumn('bulan');
            }

            if (Schema::hasColumn('gangguan', 'status_masalah')) {
                $table->dropColumn('status_masalah');
            }

            /** ============================
             * KEMBALIKAN KOLOM LAMA (OPSIONAL)
             * ============================ */
            if (!Schema::hasColumn('gangguan', 'komplain_masuk')) {
                $table->integer('komplain_masuk')->default(0);
            }

            if (!Schema::hasColumn('gangguan', 'id_perangkat')) {
                $table->unsignedBigInteger('id_perangkat')->nullable();
            }
        });
    }
}
