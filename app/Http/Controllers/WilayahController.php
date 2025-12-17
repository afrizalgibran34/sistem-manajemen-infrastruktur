<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Wilayah::paginate($perPage);
        return view('wilayah.index', compact('data'));
    }

    public function create()
    {
        return view('wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required|string|max:255'
        ]);

        Wilayah::create($request->only('nama_wilayah'));

        return redirect()->route('wilayah.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Wilayah::findOrFail($id);
        return view('wilayah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wilayah' => 'required|string|max:255'
        ]);

        $data = Wilayah::findOrFail($id);
        $data->update($request->only('nama_wilayah'));

        return redirect()->route('wilayah.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Wilayah::findOrFail($id)->delete();
        return redirect()->route('wilayah.index')->with('success', 'Data berhasil dihapus.');
    }
}
