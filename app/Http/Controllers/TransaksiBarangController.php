<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use App\Models\Lokasi;
use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiBarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = TransaksiBarang::with(['lokasi', 'barang'])->paginate($perPage)->appends($request->query());
        return view('transaksi_barang.index', compact('data'));
    }

    public function create()
    {
        return view('transaksi_barang.create', [
            'lokasi' => Lokasi::all(),
            'barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lokasi_id' => 'required',
            'barang_id' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        TransaksiBarang::create([
            'tanggal' => $request->tanggal,
            'lokasi_id' => $request->lokasi_id,
            'barang_id' => $request->barang_id,
            'jumlah' => 1, // ⬅️ DEFAULT JUMLAH
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi_barang.index')
            ->with('success', 'Transaksi barang berhasil ditambahkan');
    }



    public function edit($id)
    {
        return view('transaksi_barang.edit', [
            'data' => TransaksiBarang::findOrFail($id),
            'lokasi' => Lokasi::all(),
            'barang' => Barang::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        TransaksiBarang::findOrFail($id)->update($request->all());
        return redirect()->route('transaksi_barang.index');
    }

    public function destroy($id)
    {
        TransaksiBarang::findOrFail($id)->delete();
        return redirect()->route('transaksi_barang.index');
    }

    public function cetakPdf()
    {
        $data = TransaksiBarang::with(['barang', 'lokasi'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('laporan.barang_keluar.pdf', [
            'data' => $data
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-barang-keluar.pdf');
    }
}
