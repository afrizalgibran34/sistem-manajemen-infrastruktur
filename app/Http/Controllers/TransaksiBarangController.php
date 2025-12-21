<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use App\Models\TitikLokasi;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiBarangController extends Controller
{
    /* ================= INDEX ================= */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $data = TransaksiBarang::with([
                'stok.barang',
                'titik_lokasi'
            ])
            ->orderBy('tanggal', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return view('transaksi_barang.index', compact('data'));
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('transaksi_barang.create', [
            'titik'      => TitikLokasi::all(),
            'stokBarang' => StokBarang::with('barang')
                ->available()
                ->get()
        ]);
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'lokasi_id'  => 'required|exists:titik_lokasi,id_titik',
            'stok_id'    => 'required|exists:stok_barang,stok_id',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $stok = StokBarang::lockForUpdate()
                    ->findOrFail($request->stok_id);

                if ($stok->sisa < $request->jumlah) {
                    throw new \Exception(
                        "Stok tidak mencukupi. Sisa: {$stok->sisa}"
                    );
                }

                TransaksiBarang::create([
                    'tanggal'    => $request->tanggal,
                    'lokasi_id'  => $request->lokasi_id,
                    'stok_id'    => $stok->stok_id,
                    'jumlah'     => $request->jumlah,
                    'keterangan' => $request->keterangan,
                ]);

                $stok->terpakai += $request->jumlah;
                $stok->sisa     -= $request->jumlah;
                $stok->save();
            });
        } catch (\Exception $e) {
            return redirect()
                ->route('transaksi_barang.index')
                ->with('warning', $e->getMessage());
        }

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi berhasil, stok otomatis terupdate');
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        return view('transaksi_barang.edit', [
            'data'       => TransaksiBarang::with('stok.barang')->findOrFail($id),
            'titiks'     => TitikLokasi::all(),
            'stokBarang' => StokBarang::with('barang')->get()
        ]);
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'lokasi_id'  => 'required|exists:titik_lokasi,id_titik',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $transaksi = TransaksiBarang::findOrFail($id);
                $stok = StokBarang::lockForUpdate()
                    ->findOrFail($transaksi->stok_id);

                $selisih = $request->jumlah - $transaksi->jumlah;

                if ($selisih > 0 && $stok->sisa < $selisih) {
                    throw new \Exception(
                        "Stok tidak mencukupi. Sisa: {$stok->sisa}"
                    );
                }

                $stok->terpakai += $selisih;
                $stok->sisa     -= $selisih;
                $stok->save();

                $transaksi->update([
                    'tanggal'    => $request->tanggal,
                    'lokasi_id'  => $request->lokasi_id,
                    'jumlah'     => $request->jumlah,
                    'keterangan' => $request->keterangan,
                ]);
            });
        } catch (\Exception $e) {
            return redirect()
                ->route('transaksi_barang.index')
                ->with('warning', $e->getMessage());
        }

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi & stok berhasil diperbarui');
    }

    /* ================= DESTROY ================= */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $transaksi = TransaksiBarang::findOrFail($id);
            $stok = StokBarang::lockForUpdate()
                ->findOrFail($transaksi->stok_id);

            $stok->terpakai -= $transaksi->jumlah;
            $stok->sisa     += $transaksi->jumlah;
            $stok->save();

            $transaksi->delete();
        });

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi dihapus & stok dikembalikan');
    }

    /* ================= PDF ================= */
    public function cetakPdf()
    {
        $data = TransaksiBarang::with(['stok.barang', 'titik_lokasi'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('transaksi_barang.pdf', [
            'data' => $data
        ])->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-barang-keluar.pdf');
    }
}
