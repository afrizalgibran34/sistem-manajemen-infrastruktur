<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {

            // Hapus foreign key dulu (nama sesuai default laravel)
            if (Schema::hasColumn('titik_lokasi', 'id_koneksi')) {
                $table->dropForeign(['id_koneksi']);
            }

            if (Schema::hasColumn('titik_lokasi', 'id_status')) {
                $table->dropForeign(['id_status']);
            }

            if (Schema::hasColumn('titik_lokasi', 'id_perangkat')) {
                $table->dropForeign(['id_perangkat']);
            }

            // Setelah FK DIHAPUS → aman drop column
            if (Schema::hasColumn('titik_lokasi', 'id_koneksi')) {
                $table->dropColumn('id_koneksi');
            }
            if (Schema::hasColumn('titik_lokasi', 'id_status')) {
                $table->dropColumn('id_status');
            }
            if (Schema::hasColumn('titik_lokasi', 'id_perangkat')) {
                $table->dropColumn('id_perangkat');
            }
            if (Schema::hasColumn('titik_lokasi', 'rencana_pengembangan')) {
                $table->dropColumn('rencana_pengembangan');
            }
        });
    }

    public function down()
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_koneksi')->nullable();
            $table->unsignedBigInteger('id_status')->nullable();
            $table->unsignedBigInteger('id_perangkat')->nullable();
        });
    }
};

