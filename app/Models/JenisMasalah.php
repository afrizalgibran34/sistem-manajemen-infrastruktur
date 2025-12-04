<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisMasalah extends Model
{
    protected $table = 'jenis_masalah';
    protected $primaryKey = 'id_jenismasalah';
    protected $fillable = ['nama_masalah'];
}
