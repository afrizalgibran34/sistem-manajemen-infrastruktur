<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function index()
    {
        // Ambil semua titik dari tabel titik_lokasi
        $titik = DB::table('titik_lokasi')->get();
        
        // Kirim ke view peta/index.blade.php
        return view('peta.index', compact('titik'));
    }
}
