<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitikLokasi extends Model
{
    protected $table = 'titik_lokasi';
    protected $primaryKey = 'id_titik';

    protected $fillable = [
        'nama_titik',
        'id_wilayah',
        'id_kec_kel',
        'id_klasifikasi',
        'koneksi',
        'status',
        'perangkat',
        'panjang_fo',
        'tahun_pembangunan',
        'id_backbone',
        'id_uplink',
        'keterangan',
        'latitude',
        'longitude',
    ];

    public function wilayah() { return $this->belongsTo(Wilayah::class, 'id_wilayah'); }
    public function kec_kel() { return $this->belongsTo(Kec_Kel::class, 'id_kec_kel'); }
    public function klasifikasi() { return $this->belongsTo(Klasifikasi::class, 'id_klasifikasi'); }
    public function backbone() { return $this->belongsTo(Backbone::class, 'id_backbone'); }
    public function uplink() { return $this->belongsTo(Uplink::class, 'id_uplink'); }
}
