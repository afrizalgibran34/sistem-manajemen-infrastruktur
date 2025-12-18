<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $wilayahId = $request->get('wilayah');

        $wilayahList = DB::table('wilayah')->get();

        $labels = $wilayahList->pluck('nama_wilayah');

        $jumlah = $wilayahList->map(fn ($w) =>
            DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->count()
        );

        $onPerWilayah = $wilayahList->map(fn ($w) =>
            DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->where('status', 'ON')
                ->count()
        );

        $offPerWilayah = $wilayahList->map(fn ($w) =>
            DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->where('status', 'OFF')
                ->count()
        );

        $on  = DB::table('titik_lokasi')->where('status', 'ON')->count();
        $off = DB::table('titik_lokasi')->where('status', 'OFF')->count();

        $query = DB::table('titik_lokasi')
            ->select('tahun_pembangunan', DB::raw('COUNT(*) as total'));

        if ($wilayahId) {
            $query->where('id_wilayah', $wilayahId);
        }

        $serverPerTahun = $query
            ->groupBy('tahun_pembangunan')
            ->orderBy('tahun_pembangunan')
            ->get();

        return view('dashboard', [
            'labels' => $labels,
            'jumlah' => $jumlah,
            'onPerWilayah' => $onPerWilayah,
            'offPerWilayah' => $offPerWilayah,
            'on' => $on,
            'off' => $off,
            'wilayahList' => $wilayahList,
            'wilayahId' => $wilayahId,
            'tahunLabels' => $serverPerTahun->pluck('tahun_pembangunan'),
            'jumlahServer' => $serverPerTahun->pluck('total'),
        ]);
    }
}
