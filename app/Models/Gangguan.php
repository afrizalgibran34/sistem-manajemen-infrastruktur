<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gangguan extends Model
{
    protected $table = 'gangguan';
    protected $primaryKey = 'id_gangguan';

    protected $fillable = [
        'tanggal',
        'bulan',
        'id_titik',
        'id_wilayah',
        'fo_wireless',
        'id_jenismasalah',
        'keterangan',
        'penanganan',
        'jumlah_kunjungan',
        'status_masalah'
    ];

    // Relasi
    public function titik()
    {
        return $this->belongsTo(TitikLokasi::class, 'id_titik');
    }

    public function jenis_masalah()
    {
        return $this->belongsTo(JenisMasalah::class, 'id_jenismasalah');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }
}
