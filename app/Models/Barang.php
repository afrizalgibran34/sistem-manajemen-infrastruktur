<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tabel_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['nama_barang', 'satuan'];
}
