<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use Illuminate\Http\Request;

class BulanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Bulan::paginate($perPage)->withQueryString();
        return view('bulan.index', compact('data'));
    }

    public function create()
    {
        return view('bulan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_bulan' => 'required']);
        Bulan::create($request->all());

        return redirect()->route('bulan.index');
    }

    public function edit($id)
    {
        $data = Bulan::findOrFail($id);
        return view('bulan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_bulan' => 'required']);
        Bulan::findOrFail($id)->update($request->all());

        return redirect()->route('bulan.index');
    }

    public function destroy($id)
    {
        Bulan::findOrFail($id)->delete();
        return redirect()->route('bulan.index');
    }
}