<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $wilayahId = $request->get('wilayah');

        // =========================
        // DATA LAMA (TIDAK DIUBAH)
        // =========================
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

            // =================================================
            // 🔽 FILTER & CHART PANJANG KABEL FO (FIX BENERAN)
            // =================================================
            $foMode = $request->get('fo_mode');

            $foLabels = [];
            $foData   = [];

            // 🔹 BERDASARKAN WILAYAH (GROUP BY WILAYAH)
            if ($foMode === 'id_wilayah') {

                $data = DB::table('titik_lokasi')
                    ->join('wilayah', 'titik_lokasi.id_wilayah', '=', 'wilayah.id_wilayah')
                    ->select(
                        'wilayah.nama_wilayah',
                        DB::raw('SUM(titik_lokasi.panjang_fo) as total_fo')
                    )
                    ->groupBy('wilayah.nama_wilayah')
                    ->get();

                $foLabels = $data->pluck('nama_wilayah');
                $foData   = $data->pluck('total_fo');

            }

            // 🔹 BERDASARKAN TITIK LOKASI (PER TITIK)
            elseif ($foMode === 'id_titik') {

                $data = DB::table('titik_lokasi')
                    ->select('nama_titik', 'panjang_fo')
                    ->whereNotNull('panjang_fo')
                    ->get();

                $foLabels = $data->pluck('nama_titik');
                $foData   = $data->pluck('panjang_fo');

            }

            // 🔹 BERDASARKAN TAHUN PEMBANGUNAN
            elseif ($foMode === 'tahun_pembangunan') {

                $data = DB::table('titik_lokasi')
                    ->select(
                        'tahun_pembangunan',
                        DB::raw('SUM(panjang_fo) as total_fo')
                    )
                    ->whereNotNull('tahun_pembangunan')
                    ->groupBy('tahun_pembangunan')
                    ->orderBy('tahun_pembangunan')
                    ->get();

                $foLabels = $data->pluck('tahun_pembangunan');
                $foData   = $data->pluck('total_fo');
            }


            // 🔹 DEFAULT (TOTAL)
            else {
                $total = DB::table('titik_lokasi')->sum('panjang_fo');

                $foLabels = ['Total Panjang Kabel FO'];
                $foData   = [$total];
            }

                    // RETURN VIEW
                    // =========================
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

                        // 🔽 FO CHART
                        'foLabels' => $foLabels,
                        'foData' => $foData,
                    ]);
                    
                }
    public function gangguanChart(Request $request)
{
    $mode = $request->mode ?? 'jenis_koneksi';

    $query = DB::table('titik_lokasi');

    // ================= FILTER WAKTU (OPSIONAL) =================
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date,
            $request->end_date
        ]);
    }

    // ================= MODE ANALISIS =================
    switch ($mode) {

        case 'jenis_koneksi':
            $data = $query
                ->select('koneksi', DB::raw('COUNT(*) as total'))
                ->whereNotNull('koneksi')
                ->groupBy('koneksi')
                ->get();

            return response()->json([
                'chart_type' => 'pie',
                'label' => 'Jumlah Gangguan',
                'labels' => $data->pluck('koneksi'),
                'values' => $data->pluck('total')
            ]);

        case 'wilayah':
            $data = $query
                ->join('wilayah', 'titik_lokasi.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select('wilayah.nama_wilayah', DB::raw('COUNT(*) as total'))
                ->groupBy('wilayah.nama_wilayah')
                ->get();

            return response()->json([
                'chart_type' => 'bar',
                'label' => 'Jumlah Gangguan',
                'labels' => $data->pluck('nama_wilayah'),
                'values' => $data->pluck('total')
            ]);

        case 'titik':
            $data = $query
                ->select('nama_titik', DB::raw('COUNT(*) as total'))
                ->groupBy('nama_titik')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            return response()->json([
                'chart_type' => 'bar',
                'label' => 'Top 10 Titik Gangguan',
                'labels' => $data->pluck('nama_titik'),
                'values' => $data->pluck('total')
            ]);

        default:
            return response()->json([
                'chart_type' => 'bar',
                'label' => 'Data Kosong',
                'labels' => [],
                'values' => []
            ]);
    }
}
}

