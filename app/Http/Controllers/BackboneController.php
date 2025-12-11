<?php

namespace App\Http\Controllers;

use App\Models\Backbone;
use Illuminate\Http\Request;

class BackboneController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Backbone::paginate($perPage)->withQueryString();
        return view('backbone.index', compact('data'));
    }

    public function create()
    {
        return view('backbone.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_backbone' => 'required|string|max:255'
        ]);

        Backbone::create([
            'jenis_backbone' => $request->jenis_backbone
        ]);

        return redirect()->route('backbone.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Backbone::findOrFail($id);
        return view('backbone.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_backbone' => 'required|string|max:255'
        ]);

        $data = Backbone::findOrFail($id);
        $data->update([
            'jenis_backbone' => $request->jenis_backbone
        ]);

        return redirect()->route('backbone.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Backbone::findOrFail($id)->delete();
        return redirect()->route('backbone.index')->with('success', 'Data berhasil dihapus');
    }
}
