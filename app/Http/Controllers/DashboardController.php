<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // =================================================
        // FILTER DASAR
        // =================================================
        $wilayahId = $request->get('wilayah');

        // =================================================
        // DATA WILAYAH & TITIK
        // =================================================
        $wilayahList = DB::table('wilayah')->get();

        $labels = $wilayahList->pluck('nama_wilayah');

        $jumlah = $wilayahList->map(function ($w) {
            return DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->count();
        });

        $onPerWilayah = $wilayahList->map(function ($w) {
            return DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->where('status', 'ON')
                ->count();
        });

        $offPerWilayah = $wilayahList->map(function ($w) {
            return DB::table('titik_lokasi')
                ->where('id_wilayah', $w->id_wilayah)
                ->where('status', 'OFF')
                ->count();
        });

        $on  = DB::table('titik_lokasi')->where('status', 'ON')->count();
        $off = DB::table('titik_lokasi')->where('status', 'OFF')->count();

        // =================================================
        // SERVER PER TAHUN
        // =================================================
        $serverQuery = DB::table('titik_lokasi')
            ->select('tahun_pembangunan', DB::raw('COUNT(*) as total'));

        if ($wilayahId) {
            $serverQuery->where('id_wilayah', $wilayahId);
        }

        $serverPerTahun = $serverQuery
            ->groupBy('tahun_pembangunan')
            ->orderBy('tahun_pembangunan')
            ->get();

        // =================================================
        // PANJANG KABEL FO
        // =================================================
        $foMode = $request->get('fo_mode');

        if ($foMode === 'id_wilayah') {

            $fo = DB::table('titik_lokasi')
                ->join('wilayah', 'titik_lokasi.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select(
                    'wilayah.nama_wilayah',
                    DB::raw('SUM(titik_lokasi.panjang_fo) as total_fo')
                )
                ->groupBy('wilayah.nama_wilayah')
                ->get();

            $foLabels = $fo->pluck('nama_wilayah');
            $foData   = $fo->pluck('total_fo');

        } elseif ($foMode === 'id_titik') {

            $fo = DB::table('titik_lokasi')
                ->select('nama_titik', 'panjang_fo')
                ->whereNotNull('panjang_fo')
                ->get();

            $foLabels = $fo->pluck('nama_titik');
            $foData   = $fo->pluck('panjang_fo');

        } elseif ($foMode === 'tahun_pembangunan') {

            $fo = DB::table('titik_lokasi')
                ->select(
                    'tahun_pembangunan',
                    DB::raw('SUM(panjang_fo) as total_fo')
                )
                ->whereNotNull('tahun_pembangunan')
                ->groupBy('tahun_pembangunan')
                ->orderBy('tahun_pembangunan')
                ->get();

            $foLabels = $fo->pluck('tahun_pembangunan');
            $foData   = $fo->pluck('total_fo');

        } else {

            $foLabels = ['Total Panjang Kabel FO'];
            $foData   = [DB::table('titik_lokasi')->sum('panjang_fo')];
        }

        // =================================================
        // STOK BARANG
        // =================================================
        $stokMode = $request->get('stok_mode', 'besaran');

        if ($stokMode === 'tahun_pengadaan') {

            $stok = DB::table('stok_barang')
                ->select(
                    'tahun_pengadaan',
                    DB::raw('SUM(CAST(kuantitas AS UNSIGNED)) as total_stok')
                )
                ->whereNotNull('tahun_pengadaan')
                ->groupBy('tahun_pengadaan')
                ->orderBy('tahun_pengadaan')
                ->get();

            $stokLabels = $stok->pluck('tahun_pengadaan');
            $stokData   = $stok->pluck('total_stok');

        } else {

            $stok = DB::table('stok_barang')
                ->join('tabel_barang', 'stok_barang.barang_id', '=', 'tabel_barang.barang_id')
                ->select(
                    'tabel_barang.nama_barang',
                    DB::raw('SUM(CAST(stok_barang.kuantitas AS UNSIGNED)) as total_stok')
                )
                ->groupBy('tabel_barang.nama_barang')
                ->orderBy('tabel_barang.nama_barang')
                ->get();

            $stokLabels = $stok->pluck('nama_barang');
            $stokData   = $stok->pluck('total_stok');
        }

        // =================================================
        // TRANSAKSI BARANG (FIXED)
        // transaksi_barang -> stok_barang -> tabel_barang
        // =================================================
        $transaksiMode = $request->get('transaksi_mode', 'besaran');

        if ($transaksiMode === 'tahun_pengadaan') {

            $trx = DB::table('transaksi_barang')
                ->join('stok_barang', 'transaksi_barang.stok_id', '=', 'stok_barang.stok_id')
                ->select(
                    'stok_barang.tahun_pengadaan',
                    DB::raw('SUM(transaksi_barang.jumlah) as total_transaksi')
                )
                ->whereNotNull('stok_barang.tahun_pengadaan')
                ->groupBy('stok_barang.tahun_pengadaan')
                ->orderBy('stok_barang.tahun_pengadaan')
                ->get();

            $transaksiLabels = $trx->pluck('tahun_pengadaan');
            $transaksiData   = $trx->pluck('total_transaksi');

        } else {

            $trx = DB::table('transaksi_barang')
                ->join('stok_barang', 'transaksi_barang.stok_id', '=', 'stok_barang.stok_id')
                ->join('tabel_barang', 'stok_barang.barang_id', '=', 'tabel_barang.barang_id')
                ->select(
                    'tabel_barang.nama_barang',
                    DB::raw('SUM(transaksi_barang.jumlah) as total_transaksi')
                )
                ->groupBy('tabel_barang.nama_barang')
                ->orderByDesc('total_transaksi')
                ->get();

            $transaksiLabels = $trx->pluck('nama_barang');
            $transaksiData   = $trx->pluck('total_transaksi');
        }

        // =================================================
        // RETURN VIEW
        // =================================================
        return view('dashboard', compact(
            'labels',
            'jumlah',
            'onPerWilayah',
            'offPerWilayah',
            'on',
            'off',
            'wilayahList',
            'wilayahId',
            'foLabels',
            'foData',
            'stokLabels',
            'stokData',
            'transaksiLabels',
            'transaksiData'
        ))->with([
            'tahunLabels' => $serverPerTahun->pluck('tahun_pembangunan'),
            'jumlahServer' => $serverPerTahun->pluck('total'),
        ]);
    }

    // =================================================
    // API GANGGUAN (UPDATED - FROM GANGGUAN TABLE)
    // =================================================
    public function gangguanChart(Request $request)
    {
        $mode = $request->mode ?? 'jenis_masalah';
        $status = $request->status;

        $query = DB::table('gangguan');

        // Filter by date range if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Filter by status if provided (case-insensitive)
        if (!empty($status)) {
            $query->where('status_masalah', $status);
        }

        switch ($mode) {
            case 'jenis_masalah':
                // Get data from gangguan table, join with jenis_masalah to get nama_masalah
                $data = $query
                    ->join('jenis_masalah', 'gangguan.id_jenismasalah', '=', 'jenis_masalah.id_jenismasalah')
                    ->select('jenis_masalah.nama_masalah', DB::raw('COUNT(*) as total'))
                    ->groupBy('jenis_masalah.nama_masalah')
                    ->orderByDesc('total')
                    ->get();

                return response()->json([
                    'chart_type' => 'bar',
                    'label' => 'Jumlah Gangguan per Jenis Masalah',
                    'labels' => $data->pluck('nama_masalah'),
                    'values' => $data->pluck('total')
                ]);

            case 'wilayah':
                $data = $query
                    ->join('titik_lokasi', 'gangguan.id_titik', '=', 'titik_lokasi.id_titik')
                    ->join('wilayah', 'titik_lokasi.id_wilayah', '=', 'wilayah.id_wilayah')
                    ->select('wilayah.nama_wilayah', DB::raw('COUNT(*) as total'))
                    ->groupBy('wilayah.nama_wilayah')
                    ->orderByDesc('total')
                    ->get();

                return response()->json([
                    'chart_type' => 'bar',
                    'label' => 'Jumlah Gangguan per Wilayah',
                    'labels' => $data->pluck('nama_wilayah'),
                    'values' => $data->pluck('total')
                ]);

            case 'titik':
                $data = $query
                    ->join('titik_lokasi', 'gangguan.id_titik', '=', 'titik_lokasi.id_titik')
                    ->select('titik_lokasi.nama_titik', DB::raw('COUNT(*) as total'))
                    ->groupBy('titik_lokasi.nama_titik')
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
                    'label' => 'Jumlah Gangguan',
                    'labels' => [],
                    'values' => []
                ]);
        }
    }

    public function getCableChart(Request $request)
    {
        $wilayahId = $request->get('wilayah');

        // Query untuk FO: hitung jumlah titik dengan koneksi FO atau panjang_fo tidak null
        $foQuery = DB::table('titik_lokasi')
            ->where(function ($q) {
                $q->where('koneksi', 'FO')
                  ->orWhereNotNull('panjang_fo');
            });

        if ($wilayahId) {
            $foQuery->where('id_wilayah', $wilayahId);
        }

        $foCount = $foQuery->count();

        // Query untuk Wireless: hitung jumlah titik dengan koneksi wireless
        $wirelessQuery = DB::table('titik_lokasi')
            ->where('koneksi', 'Wireless');

        if ($wilayahId) {
            $wirelessQuery->where('id_wilayah', $wilayahId);
        }

        $wirelessCount = $wirelessQuery->count();

        return response()->json([
            'fo' => $foCount,
            'wireless' => $wirelessCount
        ]);
    }

    public function getFoTotal(Request $request)
    {
        $wilayahId = $request->get('wilayah');

        $foQuery = DB::table('titik_lokasi')
            ->select(DB::raw('SUM(panjang_fo) as total'))
            ->whereNotNull('panjang_fo');

        if ($wilayahId) {
            $foQuery->where('id_wilayah', $wilayahId);
        }

        $total = $foQuery->first()->total ?? 0;

        return response()->json([
            'total' => number_format($total, 0, ',', '.')
        ]);
    }

    public function getStokChart(Request $request)
    {
        $type = $request->get('type', 'kuantitas');
        
        // Pilih field berdasarkan type filter
        $field = $type === 'sisa' ? 'sisa' : 'kuantitas';
        
        $stok = DB::table('stok_barang')
            ->join('tabel_barang', 'stok_barang.barang_id', '=', 'tabel_barang.barang_id')
            ->select(
                'tabel_barang.nama_barang',
                DB::raw("SUM(CAST(stok_barang.{$field} AS UNSIGNED)) as total_stok")
            )
            ->groupBy('tabel_barang.nama_barang')
            ->orderByDesc('total_stok')
            ->get();

        return response()->json([
            'labels' => $stok->pluck('nama_barang'),
            'data' => $stok->pluck('total_stok')
        ]);
    }
}