<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kec_Kel extends Model
{
    protected $table = 'kec_kel';
    protected $primaryKey = 'id_kec_kel';
    protected $fillable = ['nama_kec_kel'];
}
