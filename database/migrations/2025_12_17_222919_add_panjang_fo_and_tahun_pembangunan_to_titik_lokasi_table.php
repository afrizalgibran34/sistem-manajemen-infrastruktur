<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {
            $table->integer('panjang_fo')->nullable()->after('koneksi');
            $table->year('tahun_pembangunan')->after('panjang_fo');
        });
    }

    public function down(): void
    {
        Schema::table('titik_lokasi', function (Blueprint $table) {
            $table->dropColumn(['panjang_fo', 'tahun_pembangunan']);
        });
    }
};
