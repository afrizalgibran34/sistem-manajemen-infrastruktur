<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $data = Lokasi::all();
        return view('lokasi.index', compact('data'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required'
        ]);

        Lokasi::create($request->all());
        return redirect()->route('lokasi.index');
    }

    public function edit($id)
    {
        $data = Lokasi::findOrFail($id);
        return view('lokasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Lokasi::findOrFail($id)->update($request->all());
        return redirect()->route('lokasi.index');
    }

    public function destroy($id)
    {
        Lokasi::findOrFail($id)->delete();
        return redirect()->route('lokasi.index');
    }
}
