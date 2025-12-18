<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    protected $table = 'transaksi_barang';
    protected $primaryKey = 'transaksi_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tanggal',
        'lokasi_id',
        'barang_id',
        'jumlah',
        'keterangan'
    ];

    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id',   // FK di transaksi_barang
            'barang_id'    // PK di tabel_barang
        );
    }

    public function titik_lokasi()
    {
        return $this->belongsTo(
            TitikLokasi::class,
            'lokasi_id',   // FK
            'id_titik'     // PK
        );
    }
}
