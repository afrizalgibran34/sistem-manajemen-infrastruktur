<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;



class StokBarangController extends Controller
{
      public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        /**
         * ============================
         * DATA UTAMA (SEMUA STOK)
         * ============================
         */
        $data = StokBarang::with('barang')
            ->paginate($perPage)
            ->appends($request->query());

        /**
         * ============================
         * DATA ASET > 5 TAHUN (DETAIL)
         * ============================
         */
        $asetTuaData = StokBarang::with('barang')
            ->whereNotNull('tahun_pengadaan')
            ->whereRaw('YEAR(CURDATE()) - tahun_pengadaan >= 5')
            ->orderBy('tahun_pengadaan', 'asc')
            ->get();

        /**
         * ============================
         * TOTAL ASET TUA
         * ============================
         */
        $asetTua = $asetTuaData->count();

        return view('stok_barang.index', compact(
            'data',
            'asetTua',
            'asetTuaData'
        ));
    }

    public function create()
    {
        return view('stok_barang.create', [
            'barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'        => 'required|exists:tabel_barang,barang_id',
            'tahun_pengadaan'  => 'required|integer',
            'kuantitas'        => 'required|integer|min:1',
            'satuan'           => 'required|string',
            'keterangan'       => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kondisi'          => 'nullable|string',
            'spesifikasi'      => 'nullable|string',
        ]);

        // cek stok existing
        $existing = StokBarang::where('barang_id', $request->barang_id)
            ->where('tahun_pengadaan', $request->tahun_pengadaan)
            ->first();

        if ($existing) {
            return redirect()
                ->route('stok_barang.edit', $existing->stok_id)
                ->with('warning',
                    'Barang dengan tahun yang sama sudah tersedia. Silakan edit data stok yang ada.'
                );
        }

        // ===== HANDLE FOTO =====
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('stok_barang', 'public');
        }

        // buat stok baru
        StokBarang::create([
            'barang_id'        => $request->barang_id,
            'tahun_pengadaan'  => $request->tahun_pengadaan,
            'satuan'           => $request->satuan,
            'kuantitas'        => $request->kuantitas,
            'terpakai'         => 0,
            'sisa'             => $request->kuantitas,
            'keterangan'       => $request->keterangan,
            'foto'             => $fotoPath,
            'kondisi'          => $request->kondisi,
            'spesifikasi'      => $request->spesifikasi,
        ]);

        return redirect()
            ->route('stok_barang.index')
            ->with('success', 'Stok barang berhasil ditambahkan');
    }




    public function edit($id)
    {
        return view('stok_barang.edit', [
            'data' => StokBarang::findOrFail($id),
            'barang' => Barang::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $stok = StokBarang::findOrFail($id);

        $request->validate([
            'barang_id' => 'required',
            'satuan' => 'required',
            'kuantitas' => 'required|integer|min:1',
            'terpakai' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_pengadaan' => 'nullable|integer',
        ]);

        // nilai aman
        $terpakai = $request->terpakai ?? 0;
        $sisa = $request->kuantitas - $terpakai;

        // ===== HANDLE FOTO =====
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($stok->foto && Storage::disk('public')->exists($stok->foto)) {
                Storage::disk('public')->delete($stok->foto);
            }

            // simpan foto baru
            $fotoPath = $request->file('foto')->store('stok_barang', 'public');
        } else {
            $fotoPath = $stok->foto;
        }

        // update data (TANPA stok_id)
        $stok->update([
            'barang_id' => $request->barang_id,
            'satuan' => $request->satuan,
            'kuantitas' => $request->kuantitas,
            'terpakai' => $terpakai,
            'sisa' => $sisa,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'kondisi' => $request->kondisi,
            'spesifikasi' => $request->spesifikasi,
            'tahun_pengadaan' => $request->tahun_pengadaan,
        ]);

        return redirect()->route('stok_barang.index')
            ->with('success', 'Stok barang berhasil diperbarui');
    }




   public function destroy($id)
    {
        $stok = StokBarang::findOrFail($id);

        if ($stok->foto && Storage::disk('public')->exists($stok->foto)) {
            Storage::disk('public')->delete($stok->foto);
        }

        $stok->delete();

        return redirect()->route('stok_barang.index')
            ->with('success', 'Stok barang berhasil dihapus');
    }

    public function getJenisBarang($id)
    {
        $barang = Barang::findOrFail($id);

        return response()->json([
            'jenis_barang' => $barang->jenis_barang
        ]);
    }

    public function exportPdf()
    {
        $data = StokBarang::with('barang')->get();

        $pdf = Pdf::loadView('stok_barang.pdf', [
            'data' => $data
        ])->setPaper('A4', 'landscape');

        return $pdf->stream('stok-barang.pdf');
    }


}
