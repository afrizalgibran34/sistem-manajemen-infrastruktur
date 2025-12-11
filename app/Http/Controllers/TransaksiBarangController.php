<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use App\Models\Lokasi;
use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Http\Request;

class TransaksiBarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = TransaksiBarang::with(['lokasi', 'barang'])->paginate($perPage)->withQueryString();
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
            'jumlah' => 'required|integer|min:1'
        ]);

        // Ambil stok barang berdasar barang_id
        $stok = StokBarang::where('barang_id', $request->barang_id)->first();

        if (!$stok) {
            return back()->withErrors('Data stok barang tidak ditemukan.');
        }

        // Cek stok tersisa cukup
        if ($request->jumlah > $stok->sisa) {
            return back()->withErrors('Jumlah melebihi stok tersisa.');
        }

        // Update stok
        $stok->terpakai = $stok->terpakai + $request->jumlah;
        $stok->sisa = $stok->kuantitas - $stok->terpakai;
        $stok->save();

        // Simpan transaksi
        TransaksiBarang::create([
            'tanggal' => $request->tanggal,
            'lokasi_id' => $request->lokasi_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi_barang.index')
            ->with('success', 'Transaksi berhasil ditambahkan & stok diperbarui.');
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
