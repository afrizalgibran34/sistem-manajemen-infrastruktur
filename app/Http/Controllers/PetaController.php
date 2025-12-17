<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TitikLokasi;

class PetaController extends Controller
{
    public function index(Request $request)
    {
        // Query builder untuk titik lokasi dengan relasi
        $query = TitikLokasi::with(['wilayah', 'kec_kel', 'klasifikasi', 'backbone', 'uplink']);
        
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
        $kecKel = \DB::table('kec_kel')
            ->orderBy('nama_kec_kel', 'asc')
            ->get();
        
        // Kirim ke view peta/index.blade.php
        return view('peta.index', compact('titik', 'kecKel'));
    }

    /**
     * Return JSON detail for a single titik lokasi
     */
    public function detail($id)
    {
        $titik = TitikLokasi::with(['wilayah', 'kec_kel', 'klasifikasi', 'backbone', 'uplink'])->find($id);

        if (! $titik) {
            return response()->json(['message' => 'Not found'], 404);
        }

        // Return all fields from titik_lokasi and related names if present
        return response()->json($titik);
    }
}
