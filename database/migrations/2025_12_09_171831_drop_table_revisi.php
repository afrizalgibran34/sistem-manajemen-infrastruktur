<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('koneksi');
        Schema::dropIfExists('status');
        Schema::dropIfExists('perangkat');
    }

    public function down()
    {
        Schema::create('koneksi', function (Blueprint $table) {
            $table->id('id_koneksi');
            $table->string('jenis_koneksi');
            $table->timestamps();
        });

        Schema::create('status', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('perangkat', function (Blueprint $table) {
            $table->id('id_perangkat');
            $table->string('jenis_perangkat');
            $table->timestamps();
        });
    }
};

