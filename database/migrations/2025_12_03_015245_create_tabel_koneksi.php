<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('koneksi', function (Blueprint $table) {
            $table->increments('id_koneksi');
            $table->string('jenis_koneksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koneksi');
    }
};
