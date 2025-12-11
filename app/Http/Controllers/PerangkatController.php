<?php

namespace App\Http\Controllers;

use App\Models\Perangkat;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Perangkat::paginate($perPage)->withQueryString();
        return view('perangkat.index', compact('data'));
    }

    public function create()
    {
        return view('perangkat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_perangkat' => 'required|string|max:255'
        ]);

        Perangkat::create([
            'jenis_perangkat' => $request->jenis_perangkat
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Perangkat::findOrFail($id);
        return view('perangkat.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_perangkat' => 'required|string|max:255'
        ]);

        $data = Perangkat::findOrFail($id);
        $data->update([
            'jenis_perangkat' => $request->jenis_perangkat
        ]);

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Perangkat::findOrFail($id)->delete();

        return redirect()->route('perangkat.index')->with('success', 'Data berhasil dihapus');
    }
}
