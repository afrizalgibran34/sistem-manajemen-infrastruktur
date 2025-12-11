<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Status::paginate($perPage)->withQueryString();
        return view('status.index', compact('data'));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        Status::create([
            'status' => $request->status
        ]);

        return redirect()->route('status.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Status::findOrFail($id);
        return view('status.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $data = Status::findOrFail($id);
        $data->update([
            'status' => $request->status
        ]);

        return redirect()->route('status.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Status::findOrFail($id)->delete();

        return redirect()->route('status.index')->with('success', 'Data berhasil dihapus');
    }
}
