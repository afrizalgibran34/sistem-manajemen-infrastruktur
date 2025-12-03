<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backbone extends Model
{
    protected $table = 'backbone';
    protected $primaryKey = 'id_backbone';
    protected $fillable = ['jenis_backbone'];
}
