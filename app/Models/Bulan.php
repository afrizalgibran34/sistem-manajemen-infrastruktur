<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
    protected $table = 'bulan';
    protected $primaryKey = 'id_bulan';
    protected $fillable = ['nama_bulan'];
}

