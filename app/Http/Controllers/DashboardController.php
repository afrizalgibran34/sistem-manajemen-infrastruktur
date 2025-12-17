<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\TitikLokasi;

class DashboardController extends Controller
{
    public function index()
    {
        /* ================= BAR CHART (PER WILAYAH) ================= */
        $wilayah = Wilayah::all();

        $labels = $wilayah->pluck('nama_wilayah');

        $jumlah = $wilayah->map(function ($w) {
            return TitikLokasi::where('id_wilayah', $w->id_wilayah)->count();
        });

        /* ================= PIE CHART (ON / OFF) ================= */
        $on  = TitikLokasi::where('status', 'ON')->count();
        $off = TitikLokasi::where('status', 'OFF')->count();

        return view('dashboard', compact(
            'labels',
            'jumlah',
            'on',
            'off'
        ));
    }
}
