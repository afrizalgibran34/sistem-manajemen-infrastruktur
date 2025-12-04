<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gangguan extends Model
{
    protected $table = 'gangguan';
    protected $primaryKey = 'id_gangguan';

    protected $fillable = [
        'tanggal',
        'id_wilayah',
        'id_perangkat',
        'fo_wireless',
        'id_jenismasalah',
        'keterangan',
        'penanganan',
        'jumlah_kunjungan',
        'komplain_masuk',
        'masalah_selesai',
        'masalah_tidak_selesai'
    ];

    public function wilayah() { return $this->belongsTo(Wilayah::class, 'id_wilayah'); }
    public function perangkat() { return $this->belongsTo(PerangkatDaerah::class, 'id_perangkat'); }
    public function jenis_masalah() { return $this->belongsTo(JenisMasalah::class, 'id_jenismasalah'); }
}
