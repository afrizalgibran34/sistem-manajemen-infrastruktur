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
        Schema::table('tabel_barang', function (Blueprint $table) {
            $table->dropColumn('satuan');
            $table->string('jenis_barang');
        });
    }

    public function down()
    {
        Schema::table('tabel_barang', function (Blueprint $table) {
            $table->string('satuan');
            $table->dropColumn('jenis_barang');
        });
    }

};
