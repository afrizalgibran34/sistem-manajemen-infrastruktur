<?php

namespace App\Http\Controllers;

use App\Models\Uplink;
use Illuminate\Http\Request;

class UplinkController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Uplink::paginate($perPage)->withQueryString();
        return view('uplink.index', compact('data'));
    }

    public function create()
    {
        return view('uplink.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_uplink' => 'required|string|max:255'
        ]);

        Uplink::create([
            'jenis_uplink' => $request->jenis_uplink
        ]);

        return redirect()->route('uplink.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Uplink::findOrFail($id);
        return view('uplink.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_uplink' => 'required|string|max:255'
        ]);

        $data = Uplink::findOrFail($id);
        $data->update([
            'jenis_uplink' => $request->jenis_uplink
        ]);

        return redirect()->route('uplink.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Uplink::findOrFail($id)->delete();

        return redirect()->route('uplink.index')->with('success', 'Data berhasil dihapus');
    }
}
