<?php

namespace App\Http\Controllers;

use App\Models\TitikLokasi;
use App\Models\Wilayah;
use App\Models\Kec_Kel;
use App\Models\Klasifikasi;
use App\Models\Koneksi;
use App\Models\Status;
use App\Models\Backbone;
use App\Models\Uplink;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class TitikLokasiController extends Controller
{
    public function index()
    {
        $data = TitikLokasi::with([
            'wilayah', 'kec_kel', 'klasifikasi',  'backbone', 'uplink'
        ])->get();

        return view('titik_lokasi.index', compact('data'));
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
        ]);

        TitikLokasi::create([
            'nama_titik' => $request->nama_titik,
            'id_wilayah' => $request->id_wilayah,
            'id_kec_kel' => $request->id_kec_kel,
            'id_klasifikasi' => $request->id_klasifikasi,
            'koneksi' => $request->koneksi,
            'status' => $request->status,
            'perangkat' => $request->perangkat,
            'id_backbone' => $request->id_backbone,
            'id_uplink' => $request->id_uplink,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('titik_lokasi.index')
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
        ]);

        $data = TitikLokasi::findOrFail($id);

        $data->update([
            'nama_titik' => $request->nama_titik,
            'id_wilayah' => $request->id_wilayah,
            'id_kec_kel' => $request->id_kec_kel,
            'id_klasifikasi' => $request->id_klasifikasi,
            'koneksi' => $request->koneksi,
            'status' => $request->status,
            'perangkat' => $request->perangkat,
            'id_backbone' => $request->id_backbone,
            'id_uplink' => $request->id_uplink,
            'keterangan' => $request->keterangan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('titik_lokasi.index')
                         ->with('success', 'Data titik lokasi berhasil diupdate.');
    }



    public function destroy($id)
    {
        TitikLokasi::findOrFail($id)->delete();
        return redirect()->route('titik_lokasi.index')->with('success', 'Data berhasil dihapus');
    }
    
    public function exportPdf()
    {
        $data = TitikLokasi::with(['wilayah','kec_kel','klasifikasi','backbone','uplink'])->get();

        $pdf = Pdf::loadView('titik_lokasi.pdf', compact('data'))
                ->setPaper('a4', 'landscape'); 

        return $pdf->download('data_titik_lokasi.pdf');
    }
}
