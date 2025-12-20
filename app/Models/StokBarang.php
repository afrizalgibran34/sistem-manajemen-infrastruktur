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
    'sisa',
    'keterangan',
    'foto',
    'kondisi',
    'spesifikasi',
    'tahun_pengadaan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function transaksi()
    {
        return $this->hasMany(
            TransaksiBarang::class,
            'stok_id',
            'stok_id'
        );
    }

    public function scopeAvailable($query)
    {
        return $query->where('sisa', '>', 0);
    }
}
