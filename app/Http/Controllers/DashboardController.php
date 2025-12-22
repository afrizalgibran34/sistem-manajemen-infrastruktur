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
        // DATA WILAYAH & TITIK (LAMA)
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

        $foLabels = [];
        $foData   = [];

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
        // tabel: stok_barang + barang
        // =================================================
        $stokMode = $request->get('stok_mode', 'besaran');

        if ($stokMode === 'tahun_pengadaan') {

            // X = tahun_pengadaan | Y = jumlah stok
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

            // X = nama_barang | Y = jumlah stok
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
        // TRANSAKSI BARANG (JUMLAH TRANSAKSI)
        // tabel: transaksi_barang + barang
        // =================================================
        $transaksiMode = $request->get('transaksi_mode', 'besaran');

        if ($transaksiMode === 'tahun_pengadaan') {

            // X = tahun_pengadaan | Y = jumlah transaksi
            $trx = DB::table('transaksi_barang')
                ->join('stok_barang', 'transaksi_barang.barang_id', '=', 'stok_barang.barang_id')
                ->select(
                    'stok_barang.tahun_pengadaan',
                    DB::raw('COUNT(transaksi_barang.transaksi_id) as total_transaksi')
                )
                ->whereNotNull('stok_barang.tahun_pengadaan')
                ->groupBy('stok_barang.tahun_pengadaan')
                ->orderBy('stok_barang.tahun_pengadaan')
                ->get();

            $transaksiLabels = $trx->pluck('tahun_pengadaan');
            $transaksiData   = $trx->pluck('total_transaksi');

        } else {

            // X = nama_barang | Y = jumlah transaksi
            $trx = DB::table('transaksi_barang')
                ->join('tabel_barang', 'transaksi_barang.barang_id', '=', 'tabel_barang.barang_id')
                ->select(
                    'tabel_barang.nama_barang',
                    DB::raw('COUNT(transaksi_barang.transaksi_id) as total_transaksi')
                )
                ->groupBy('tabel_barang.nama_barang')
                ->orderBy('tabel_barang.nama_barang')
                ->get();

            $transaksiLabels = $trx->pluck('nama_barang');
            $transaksiData   = $trx->pluck('total_transaksi');
        }

        // =================================================
        // RETURN VIEW
        // =================================================
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
            'foLabels' => $foLabels,
            'foData' => $foData,
            'stokLabels' => $stokLabels,
            'stokData' => $stokData,
            'transaksiLabels' => $transaksiLabels,
            'transaksiData' => $transaksiData,
        ]);
    }

    // =================================================
    // API GANGGUAN (TETAP)
    // =================================================
    public function gangguanChart(Request $request)
    {
        $mode = $request->mode ?? 'jenis_koneksi';

        $query = DB::table('titik_lokasi');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        switch ($mode) {
            case 'jenis_koneksi':
                $data = $query
                    ->select('koneksi', DB::raw('COUNT(*) as total'))
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
        }
    }
}