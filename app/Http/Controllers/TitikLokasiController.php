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

class TitikLokasiController extends Controller
{
    public function index()
    {
        $data = TitikLokasi::with([
            'wilayah', 'kec_kel', 'klasifikasi', 'koneksi',
            'status', 'backbone', 'uplink', 'perangkat'
        ])->get();

        return view('titik_lokasi.index', compact('data'));
    }

    public function create()
    {
        return view('titik_lokasi.create', [
            'wilayah' => Wilayah::all(),
            'kec_kel' => Kec_Kel::all(),
            'klasifikasi' => Klasifikasi::all(),
            'koneksi' => Koneksi::all(),
            'status' => Status::all(),
            'backbone' => Backbone::all(),
            'uplink' => Uplink::all(),
            'perangkat' => Perangkat::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_titik' => 'required',
            'id_wilayah' => 'required',
            'id_kec_kel' => 'required',
            'id_klasifikasi' => 'required',
            'id_koneksi' => 'required',
            'id_status' => 'required',
            'id_backbone' => 'required',
            'id_uplink' => 'required',
            'id_perangkat' => 'required',
        ]);

        TitikLokasi::create($request->all());

        return redirect()->route('titik_lokasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('titik_lokasi.edit', [
            'data' => TitikLokasi::findOrFail($id),
            'wilayah' => Wilayah::all(),
            'kec_kel' => Kec_Kel::all(),
            'klasifikasi' => Klasifikasi::all(),
            'koneksi' => Koneksi::all(),
            'status' => Status::all(),
            'backbone' => Backbone::all(),
            'uplink' => Uplink::all(),
            'perangkat' => Perangkat::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = TitikLokasi::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('titik_lokasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        TitikLokasi::findOrFail($id)->delete();
        return redirect()->route('titik_lokasi.index')->with('success', 'Data berhasil dihapus');
    }
}
