<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDaerah extends Model
{
    protected $table = 'perangkat_daerah';
    protected $primaryKey = 'id_perangkat';
    protected $fillable = ['nama_perangkat'];
}
