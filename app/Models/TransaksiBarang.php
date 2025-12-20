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
        'stok_id',
        'jumlah',
        'keterangan'
    ];

    /* ================= RELATIONS ================= */

    // relasi ke stok barang
    public function stok()
    {
        return $this->belongsTo(
            StokBarang::class,
            'stok_id',
            'stok_id'
        );
    }


    public function titik_lokasi()
    {
        return $this->belongsTo(
            TitikLokasi::class,
            'lokasi_id',
            'id_titik'
        );
    }
}
