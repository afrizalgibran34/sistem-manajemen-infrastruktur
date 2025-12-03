<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uplink extends Model
{
    protected $table = 'uplink';
    protected $primaryKey = 'id_uplink';
    protected $fillable = ['jenis_uplink'];
}
