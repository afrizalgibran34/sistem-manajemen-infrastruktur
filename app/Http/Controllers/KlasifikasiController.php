<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Klasifikasi::paginate($perPage);
        return view('klasifikasi.index', compact('data'));
    }

    public function create()
    {
        return view('klasifikasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi' => 'required|string|max:255'
        ]);

        Klasifikasi::create([
            'klasifikasi' => $request->klasifikasi
        ]);

        return redirect()->route('klasifikasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Klasifikasi::findOrFail($id);
        return view('klasifikasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'klasifikasi' => 'required|string|max:255'
        ]);

        $data = Klasifikasi::findOrFail($id);
        $data->update([
            'klasifikasi' => $request->klasifikasi
        ]);

        return redirect()->route('klasifikasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Klasifikasi::findOrFail($id)->delete();
        return redirect()->route('klasifikasi.index')->with('success', 'Data berhasil dihapus');
    }
}
