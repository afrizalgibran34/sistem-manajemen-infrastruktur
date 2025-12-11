<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TabelLokasi extends Model
{
    protected $table = 'tabel_lokasi';
    protected $primaryKey = 'id'; // Ganti jika primary key berbeda
    protected $guarded = [];
    // Tambahkan relasi jika ada
}
