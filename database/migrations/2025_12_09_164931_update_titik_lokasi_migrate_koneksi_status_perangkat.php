<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {
            // Tambah kolom baru
            $table->string('koneksi')->nullable()->after('id_klasifikasi');
            $table->string('status')->nullable()->after('koneksi');
            $table->string('perangkat')->nullable()->after('status');
        });

        // MAP koneksi lama → baru
        DB::statement("
            UPDATE titik_lokasi
            SET koneksi = CASE 
                WHEN id_koneksi = 4 THEN 'FO'
                WHEN id_koneksi = 5 THEN 'Wireless'
                ELSE 'Unknown'
            END
        ");

        // MAP status lama → baru
        DB::statement("
            UPDATE titik_lokasi
            SET status = CASE 
                WHEN id_status = 3 THEN 'On'
                WHEN id_status = 4 THEN 'Off'
                ELSE 'Unknown'
            END
        ");

        // MAP perangkat lama → perangkat text dari tabel perangkat
        DB::statement("
            UPDATE titik_lokasi tl
            JOIN perangkat p ON p.id_perangkat = tl.id_perangkat
            SET tl.perangkat = p.jenis_perangkat
        ");
    }

    public function down()
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {
            $table->dropColumn(['koneksi', 'status', 'perangkat']);
        });
    }
};
