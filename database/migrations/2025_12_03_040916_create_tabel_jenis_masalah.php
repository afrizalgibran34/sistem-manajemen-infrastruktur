<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jenis_masalah', function (Blueprint $table) {
            $table->increments('id_jenismasalah'); // Primary Key
            $table->string('nama_masalah');        // Nama jenis masalah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_masalah');
    }
};
