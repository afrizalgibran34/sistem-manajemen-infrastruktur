<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDaerah;
use Illuminate\Http\Request;

class PerangkatDaerahController extends Controller
{
    public function index()
    {
        $data = PerangkatDaerah::all();
        return view('perangkatdaerah.index', compact('data'));
    }

    public function create()
    {
        return view('perangkatdaerah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_perangkat' => 'required']);
        PerangkatDaerah::create($request->all());

        return redirect()->route('perangkatdaerah.index');
    }

    public function edit($id)
    {
        $data = PerangkatDaerah::findOrFail($id);
        return view('perangkatdaerah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        PerangkatDaerah::findOrFail($id)->update($request->all());
        return redirect()->route('perangkatdaerah.index');
    }

    public function destroy($id)
    {
        PerangkatDaerah::findOrFail($id)->delete();
        return redirect()->route('perangkatdaerah.index');
    }
}
