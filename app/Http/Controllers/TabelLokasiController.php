<?php

namespace App\Http\Controllers;

use App\Models\TabelLokasi;
use Illuminate\Http\Request;

class TabelLokasiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = TabelLokasi::paginate($perPage)->withQueryString();
        return view('tabel_lokasi.index', compact('data'));
    }

    public function create()
    {
        return view('tabel_lokasi.create');
    }

    public function store(Request $request)
    {
        TabelLokasi::create($request->all());
        return redirect()->route('tabel_lokasi.index');
    }

    public function edit($id)
    {
        $data = TabelLokasi::findOrFail($id);
        return view('tabel_lokasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TabelLokasi::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('tabel_lokasi.index');
    }

    public function destroy($id)
    {
        TabelLokasi::destroy($id);
        return redirect()->route('tabel_lokasi.index');
    }
}
