<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
use App\Models\Wilayah;
use App\Models\JenisMasalah;
use App\Models\TitikLokasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GangguanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Gangguan::with(['titik', 'wilayah', 'jenis_masalah'])->paginate($perPage)->appends($request->query());
        return view('gangguan.index', compact('data'));
    }

    public function create()
    {
        return view('gangguan.create', [
            'titik' => TitikLokasi::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_titik' => 'required',
            'id_jenismasalah' => 'required',
        ]);

        $titik = TitikLokasi::findOrFail($request->id_titik);

        Gangguan::create([
            'tanggal' => $request->tanggal,
            'bulan' => date('F', strtotime($request->tanggal)),
            'id_titik' => $request->id_titik,
            'id_wilayah' => $titik->id_wilayah,
            'fo_wireless' => $titik->koneksi,
            'id_jenismasalah' => $request->id_jenismasalah,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'jumlah_kunjungan' => $request->jumlah_kunjungan ?? 0,
            'status_masalah' => $request->status_masalah,
        ]);

        return redirect()->route('gangguan.index');
    }

    public function edit($id)
    {
        return view('gangguan.edit', [
            'data' => Gangguan::findOrFail($id),
            'titik' => TitikLokasi::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Gangguan::findOrFail($id);
        $titik = TitikLokasi::findOrFail($request->id_titik);

        $data->update([
            'tanggal' => $request->tanggal,
            'bulan' => date('F', strtotime($request->tanggal)),
            'id_titik' => $request->id_titik,
            'id_wilayah' => $titik->id_wilayah,
            'fo_wireless' => $titik->koneksi,
            'id_jenismasalah' => $request->id_jenismasalah,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'jumlah_kunjungan' => $request->jumlah_kunjungan ?? 0,
            'status_masalah' => $request->status_masalah,
        ]);

        return redirect()->route('gangguan.index');
    }

    public function destroy($id)
    {
        Gangguan::findOrFail($id)->delete();
        return redirect()->route('gangguan.index');
    }

    public function exportPdf()
    {
        $data = Gangguan::with([
            'wilayah',
            'jenis_masalah',
            'titik'   // PAKAI RELASI YANG SUDAH ADA
        ])->orderBy('tanggal', 'asc')->get();

        $pdf = Pdf::loadView('gangguan.pdf', compact('data'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-gangguan-jaringan.pdf');
    }

}
