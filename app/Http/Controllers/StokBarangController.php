<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = StokBarang::with('barang')->paginate($perPage)->appends($request->query());
        return view('stok_barang.index', compact('data'));
    }

    public function create()
    {
        return view('stok_barang.create', [
            'barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'satuan' => 'required',
            'kuantitas' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $kuantitas = $request->kuantitas;

        StokBarang::create([
            'barang_id' => $request->barang_id,
            'satuan' => $request->satuan,
            'kuantitas' => $kuantitas,
            'terpakai' => 0,              // otomatis
            'sisa' => $kuantitas,          // otomatis
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('stok_barang.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('stok_barang.edit', [
            'data' => StokBarang::findOrFail($id),
            'barang' => Barang::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $stok = StokBarang::findOrFail($id);

        // Hitung sisa
        $sisa = $request->kuantitas - $request->terpakai;

        // Update manual field yang boleh diupdate
        $stok->update([
            'stok_id'     => $request->stok_id,
            'barang_id'   => $request->barang_id,
            'satuan'      => $request->satuan,
            'kuantitas'   => $request->kuantitas,
            'terpakai'    => $request->terpakai,
            'sisa'        => $sisa,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('stok_barang.index');
    }


    public function destroy($id)
    {
        StokBarang::findOrFail($id)->delete();
        return redirect()->route('stok_barang.index');
    }
}
