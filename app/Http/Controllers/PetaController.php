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
        
        // Filter berdasarkan wilayah
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }
        
        // Ambil data titik
        $titik = $query->get();
        
        // Ambil semua wilayah untuk dropdown
        $wilayah = \DB::table('wilayah')
            ->orderBy('nama_wilayah', 'asc')
            ->get();
        
        // Kirim ke view peta/index.blade.php
        return view('peta.index', compact('titik', 'wilayah'));
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
