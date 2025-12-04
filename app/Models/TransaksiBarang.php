<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    protected $table = 'transaksi_barang';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = [
        'tanggal',
        'lokasi_id',
        'barang_id',
        'jumlah',
        'keterangan'
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
