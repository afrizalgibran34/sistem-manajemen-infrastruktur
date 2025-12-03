<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bulan', function (Blueprint $table) {
            $table->increments('id_bulan'); // Primary Key
            $table->string('nama_bulan');   // Nama bulan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulan');
    }
};
