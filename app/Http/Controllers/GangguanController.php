<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
use App\Models\Wilayah;
use App\Models\PerangkatDaerah;
use App\Models\JenisMasalah;
use Illuminate\Http\Request;

class GangguanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $data = Gangguan::with(['wilayah', 'perangkat', 'jenis_masalah'])->paginate($perPage)->withQueryString();
        return view('gangguan.index', compact('data'));
    }

    public function create()
    {
        return view('gangguan.create', [
            'wilayah' => Wilayah::all(),
            'perangkat' => PerangkatDaerah::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_wilayah' => 'required',
            'id_perangkat' => 'required',
            'fo_wireless' => 'required',
            'id_jenismasalah' => 'required',
        ]);

        Gangguan::create($request->all());

        return redirect()->route('gangguan.index');
    }

    public function edit($id)
    {
        return view('gangguan.edit', [
            'data' => Gangguan::findOrFail($id),
            'wilayah' => Wilayah::all(),
            'perangkat' => PerangkatDaerah::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        Gangguan::findOrFail($id)->update($request->all());
        return redirect()->route('gangguan.index');
    }

    public function destroy($id)
    {
        Gangguan::findOrFail($id)->delete();
        return redirect()->route('gangguan.index');
    }
}
