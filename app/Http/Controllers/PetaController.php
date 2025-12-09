<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaController extends Controller
{
    public function index(Request $request)
    {
        // Query builder untuk titik lokasi
        $query = DB::table('titik_lokasi');
        
        // Filter berdasarkan pencarian nama titik
        if ($request->filled('search')) {
            $query->where('nama_titik', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan kecamatan/kelurahan
        if ($request->filled('id_kec_kel')) {
            $query->where('id_kec_kel', $request->id_kec_kel);
        }
        
        // Ambil data titik
        $titik = $query->get();
        
        // Ambil semua kecamatan/kelurahan untuk dropdown
        $kecKel = DB::table('kec_kel')
            ->orderBy('nama_kec_kel', 'asc')
            ->get();
        
        // Kirim ke view peta/index.blade.php
        return view('peta.index', compact('titik', 'kecKel'));
    }
}
