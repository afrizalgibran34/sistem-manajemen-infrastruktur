<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Barang::paginate($perPage);
        return view('barang.index', compact('data'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
            $request->validate([
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:Perangkat FO,Perangkat Wireless,Perangkat LAN',
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jenis_barang' => 'required|in:Perangkat FO,Perangkat Wireless,Perangkat LAN',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('barang.index');
    }
    public function getJenisBarang($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json([
            'jenis_barang' => $barang->jenis_barang
        ]);
    }
}
