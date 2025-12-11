<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelBarang extends Model
{
    protected $table = 'tabel_barang';
    protected $primaryKey = 'id'; // Ganti jika primary key berbeda
    protected $guarded = [];
    // Tambahkan relasi jika ada
}
