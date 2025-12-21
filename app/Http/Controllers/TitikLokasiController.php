<?php

namespace App\Http\Controllers;

use App\Models\TitikLokasi;
use App\Models\Wilayah;
use App\Models\Kec_Kel;
use App\Models\Klasifikasi;
use App\Models\Backbone;
use App\Models\Uplink;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TitikLokasiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        // Query dengan filter
        $query = TitikLokasi::with('wilayah');

        // Pencarian berdasarkan nama titik
        if ($request->filled('search')) {
            $query->where('nama_titik', 'like', '%' . $request->search . '%');
        }

        // Filter Wilayah
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Tahun Pembangunan
        if ($request->filled('tahun_dari') && $request->filled('tahun_sampai')) {
            $query->whereBetween('tahun_pembangunan', [$request->tahun_dari, $request->tahun_sampai]);
        } elseif ($request->filled('tahun_dari')) {
            $query->where('tahun_pembangunan', '>=', $request->tahun_dari);
        } elseif ($request->filled('tahun_sampai')) {
            $query->where('tahun_pembangunan', '<=', $request->tahun_sampai);
        }

        // Filter Jenis Koneksi
        if ($request->filled('koneksi')) {
            $query->where('koneksi', $request->koneksi);
        }

        $data = $query->paginate($perPage)->appends($request->except('page'));

        // === DATA CHART (JUMLAH TITIK PER WILAYAH) ===
        $chart = TitikLokasi::with('wilayah')->get();

        $labels = $chart
            ->map(fn ($row) => $row->wilayah->nama_wilayah ?? '-')
            ->unique()
            ->values();

        $jumlah = $labels->map(function ($wilayah) use ($chart) {
            return $chart->where('wilayah.nama_wilayah', $wilayah)->count();
        });

        // Data untuk dropdown filter
        $wilayahList = Wilayah::all();
        $tahunList = TitikLokasi::selectRaw('DISTINCT tahun_pembangunan')
            ->whereNotNull('tahun_pembangunan')
            ->orderBy('tahun_pembangunan', 'desc')
            ->pluck('tahun_pembangunan');
        $koneksiList = TitikLokasi::selectRaw('DISTINCT koneksi')
            ->whereNotNull('koneksi')
            ->orderBy('koneksi')
            ->pluck('koneksi');

        return view('titik_lokasi.index', compact(
            'data',
            'labels',
            'jumlah',
            'wilayahList',
            'tahunList',
            'koneksiList'
        ));
    }

    public function create()
    {
        return view('titik_lokasi.create', [
            'wilayah' => Wilayah::all(),
            'kec_kel' => Kec_Kel::all(),
            'klasifikasi' => Klasifikasi::all(),
            'backbone' => Backbone::all(),
            'uplink' => Uplink::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_titik' => 'required',
            'id_wilayah' => 'required',
            'id_kec_kel' => 'required',
            'id_klasifikasi' => 'required',
            'koneksi' => 'required',
            'status' => 'required',
            'perangkat' => 'required',
            'id_backbone' => 'required',
            'id_uplink' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tahun_pembangunan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'panjang_fo' => 'nullable|numeric|min:0',
        ]);

        TitikLokasi::create([
            'nama_titik' => $request->nama_titik,
            'id_wilayah' => $request->id_wilayah,
            'id_kec_kel' => $request->id_kec_kel,
            'id_klasifikasi' => $request->id_klasifikasi,
            'koneksi' => $request->koneksi,
            'panjang_fo' => $request->koneksi === 'FO' ? $request->panjang_fo : null,
            'tahun_pembangunan' => $request->tahun_pembangunan,
            'status' => $request->status,
            'perangkat' => $request->perangkat,
            'id_backbone' => $request->id_backbone,
            'id_uplink' => $request->id_uplink,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()
            ->route('titik_lokasi.index')
            ->with('success', 'Titik lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('titik_lokasi.edit', [
            'data' => TitikLokasi::findOrFail($id),
            'wilayah' => Wilayah::all(),
            'kec_kel' => Kec_Kel::all(),
            'klasifikasi' => Klasifikasi::all(),
            'backbone' => Backbone::all(),
            'uplink' => Uplink::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_titik' => 'required',
            'id_wilayah' => 'required',
            'id_kec_kel' => 'required',
            'id_klasifikasi' => 'required',
            'koneksi' => 'required',
            'status' => 'required',
            'perangkat' => 'required',
            'id_backbone' => 'required',
            'id_uplink' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tahun_pembangunan' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'panjang_fo' => 'nullable|numeric|min:0',
        ]);

        $data = TitikLokasi::findOrFail($id);

        $data->update([
            'nama_titik' => $request->nama_titik,
            'id_wilayah' => $request->id_wilayah,
            'id_kec_kel' => $request->id_kec_kel,
            'id_klasifikasi' => $request->id_klasifikasi,
            'koneksi' => $request->koneksi,
            'panjang_fo' => $request->koneksi === 'FO' ? $request->panjang_fo : null,
            'tahun_pembangunan' => $request->tahun_pembangunan,
            'status' => $request->status,
            'perangkat' => $request->perangkat,
            'id_backbone' => $request->id_backbone,
            'id_uplink' => $request->id_uplink,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()
            ->route('titik_lokasi.index')
            ->with('success', 'Data titik lokasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        TitikLokasi::findOrFail($id)->delete();

        return redirect()
            ->route('titik_lokasi.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        // Query dengan filter yang sama seperti index
        $query = TitikLokasi::with([
            'wilayah',
            'kec_kel',
            'klasifikasi',
            'backbone',
            'uplink'
        ]);

        // Pencarian berdasarkan nama titik
        if ($request->filled('search')) {
            $query->where('nama_titik', 'like', '%' . $request->search . '%');
        }

        // Filter Wilayah
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Tahun Pembangunan
        if ($request->filled('tahun_dari') && $request->filled('tahun_sampai')) {
            $query->whereBetween('tahun_pembangunan', [$request->tahun_dari, $request->tahun_sampai]);
        } elseif ($request->filled('tahun_dari')) {
            $query->where('tahun_pembangunan', '>=', $request->tahun_dari);
        } elseif ($request->filled('tahun_sampai')) {
            $query->where('tahun_pembangunan', '<=', $request->tahun_sampai);
        }

        // Filter Jenis Koneksi
        if ($request->filled('koneksi')) {
            $query->where('koneksi', $request->koneksi);
        }

        $data = $query->get();

        // Data filter untuk ditampilkan di PDF
        $filters = [
            'search' => $request->search,
            'wilayah' => $request->filled('id_wilayah') ? Wilayah::find($request->id_wilayah)->nama_wilayah ?? '' : null,
            'tahun_dari' => $request->tahun_dari,
            'tahun_sampai' => $request->tahun_sampai,
        ];

        $pdf = Pdf::loadView('titik_lokasi.pdf', compact('data', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('data_titik_lokasi.pdf');
    }
}