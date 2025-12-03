<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perangkat_daerah', function (Blueprint $table) {
            $table->increments('id_perangkat'); // Primary Key
            $table->string('nama_perangkat');    // Nama perangkat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perangkat_daerah');
    }
};
