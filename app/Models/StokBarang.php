<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barang';
    protected $primaryKey = 'stok_id';
    protected $fillable = [
        'barang_id',
        'satuan',
        'kuantitas',
        'terpakai',
        'keterangan',
        'sisa'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
