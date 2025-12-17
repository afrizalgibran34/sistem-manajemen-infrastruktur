<?php

namespace App\Http\Controllers;

use App\Models\TabelBarang;
use Illuminate\Http\Request;

class TabelBarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = TabelBarang::paginate($perPage);
        return view('tabel_barang.index', compact('data'));
    }

    public function create()
    {
        return view('tabel_barang.create');
    }

    public function store(Request $request)
    {
        TabelBarang::create($request->all());
        return redirect()->route('tabel_barang.index');
    }

    public function edit($id)
    {
        $data = TabelBarang::findOrFail($id);
        return view('tabel_barang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TabelBarang::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('tabel_barang.index');
    }

    public function destroy($id)
    {
        TabelBarang::destroy($id);
        return redirect()->route('tabel_barang.index');
    }
}
