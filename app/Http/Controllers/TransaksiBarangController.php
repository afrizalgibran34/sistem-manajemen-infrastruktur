<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use App\Models\Lokasi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiBarangController extends Controller
{
    public function index()
    {
        $data = TransaksiBarang::with(['lokasi', 'barang'])->get();
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
            'tanggal' => 'required',
            'lokasi_id' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required'
        ]);

        TransaksiBarang::create($request->all());
        return redirect()->route('transaksi_barang.index');
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
}
