<?php

namespace App\Http\Controllers;

use App\Models\Koneksi;
use Illuminate\Http\Request;

class KoneksiController extends Controller
{
    public function index()
    {
        $data = Koneksi::all();
        return view('koneksi.index', compact('data'));
    }

    public function create()
    {
        return view('koneksi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_koneksi' => 'required|string|max:255'
        ]);

        Koneksi::create([
            'jenis_koneksi' => $request->jenis_koneksi
        ]);

        return redirect()->route('koneksi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Koneksi::findOrFail($id);
        return view('koneksi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_koneksi' => 'required|string|max:255'
        ]);

        $data = Koneksi::findOrFail($id);
        $data->update([
            'jenis_koneksi' => $request->jenis_koneksi
        ]);

        return redirect()->route('koneksi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Koneksi::findOrFail($id)->delete();
        return redirect()->route('koneksi.index')->with('success', 'Data berhasil dihapus');
    }
}
