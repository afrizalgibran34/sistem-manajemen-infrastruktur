<?php

namespace App\Http\Controllers;

use App\Models\Kec_Kel;
use Illuminate\Http\Request;

class KecKelController extends Controller
{
    public function index()
    {
        $data = Kec_Kel::all();
        return view('kec_kel.index', compact('data'));
    }

    public function create()
    {
        return view('kec_kel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kec_kel' => 'required|string|max:255'
        ]);

        Kec_Kel::create([
            'nama_kec_kel' => $request->nama_kec_kel
        ]);

        return redirect()->route('kec_kel.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Kec_Kel::findOrFail($id);
        return view('kec_kel.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kec_kel' => 'required|string|max:255'
        ]);

        $data = Kec_Kel::findOrFail($id);
        $data->update([
            'nama_kec_kel' => $request->nama_kec_kel
        ]);

        return redirect()->route('kec_kel.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kec_Kel::findOrFail($id)->delete();

        return redirect()->route('kec_kel.index')->with('success', 'Data berhasil dihapus');
    }
}
