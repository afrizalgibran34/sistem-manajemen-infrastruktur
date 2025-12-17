<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $data = StokBarang::with('barang')->get();

        return view('dashboard', [
            'data' => $data
        ]);
    }
}
