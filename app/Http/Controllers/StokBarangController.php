<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class StokBarangController extends Controller
{
    public function index()
    {
        $data = StokBarang::with('barang')->get();
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
            'kuantitas' => 'required',
            'terpakai' => 'required',
            'sisa' => 'required'
        ]);

        StokBarang::create($request->all());
        return redirect()->route('stok_barang.index');
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
        StokBarang::findOrFail($id)->update($request->all());
        return redirect()->route('stok_barang.index');
    }

    public function destroy($id)
    {
        StokBarang::findOrFail($id)->delete();
        return redirect()->route('stok_barang.index');
    }
}
