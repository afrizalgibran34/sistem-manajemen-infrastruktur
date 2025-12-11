<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Barang::paginate($perPage)->withQueryString();
        return view('barang.index', compact('data'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required',
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
        Barang::findOrFail($id)->update($request->all());
        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('barang.index');
    }
}
