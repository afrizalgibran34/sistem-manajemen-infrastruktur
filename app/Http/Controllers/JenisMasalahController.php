<?php

namespace App\Http\Controllers;

use App\Models\JenisMasalah;
use Illuminate\Http\Request;

class JenisMasalahController extends Controller
{
    public function index()
    {
        $data = JenisMasalah::all();
        return view('jenis_masalah.index', compact('data'));
    }

    public function create()
    {
        return view('jenis_masalah.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_masalah' => 'required']);
        JenisMasalah::create($request->all());

        return redirect()->route('jenis_masalah.index');
    }

    public function edit($id)
    {
        $data = JenisMasalah::findOrFail($id);
        return view('jenis_masalah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_masalah' => 'required']);
        JenisMasalah::findOrFail($id)->update($request->all());

        return redirect()->route('jenis_masalah.index');
    }

    public function destroy($id)
    {
        JenisMasalah::findOrFail($id)->delete();
        return redirect()->route('jenis_masalah.index');
    }
}
