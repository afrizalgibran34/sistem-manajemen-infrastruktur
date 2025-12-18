<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use App\Models\TitikLokasi;
use App\Models\StokBarang;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiBarangController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $data = TransaksiBarang::with(['titik_lokasi', 'barang'])
            ->paginate($perPage)
            ->appends($request->query());

        return view('transaksi_barang.index', compact('data'));
    }

    public function create()
    {
        return view('transaksi_barang.create', [
            'titik'  => TitikLokasi::all(),
            'barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'lokasi_id'  => 'required|exists:titik_lokasi,id_titik',
            'barang_id'  => 'required|exists:tabel_barang,barang_id',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $stok = StokBarang::where('barang_id', $request->barang_id)->lockForUpdate()->firstOrFail();

            if ($stok->sisa < $request->jumlah) {
                abort(400, 'Stok barang tidak mencukupi');
            }

            TransaksiBarang::create([
                'tanggal'    => $request->tanggal,
                'lokasi_id'  => $request->lokasi_id,
                'barang_id'  => $request->barang_id,
                'jumlah'     => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            $stok->terpakai += $request->jumlah;
            $stok->sisa     -= $request->jumlah;
            $stok->save();
        });

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi berhasil, stok otomatis terupdate');
    }

    public function edit($id)
    {
        return view('transaksi_barang.edit', [
            'data'   => TransaksiBarang::findOrFail($id),
            'titiks' => TitikLokasi::all(),
            'barang' => Barang::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'lokasi_id'  => 'required|exists:titik_lokasi,id_titik',
            'barang_id'  => 'required|exists:tabel_barang,barang_id',
            'jumlah'     => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $id) {

            $transaksi = TransaksiBarang::findOrFail($id);

            $stok = StokBarang::where('barang_id', $transaksi->barang_id)
                ->lockForUpdate()
                ->firstOrFail();

            // hitung selisih jumlah
            $selisih = $request->jumlah - $transaksi->jumlah;

            if ($selisih > 0 && $stok->sisa < $selisih) {
                abort(400, 'Stok barang tidak mencukupi untuk update');
            }

            // update stok berdasarkan selisih
            $stok->terpakai += $selisih;
            $stok->sisa     -= $selisih;
            $stok->save();

            // update transaksi
            $transaksi->update([
                'tanggal'    => $request->tanggal,
                'lokasi_id'  => $request->lokasi_id,
                'barang_id'  => $request->barang_id,
                'jumlah'     => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi & stok berhasil diperbarui');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

            $transaksi = TransaksiBarang::findOrFail($id);

            $stok = StokBarang::where('barang_id', $transaksi->barang_id)
                ->lockForUpdate()
                ->firstOrFail();

            // kembalikan stok
            $stok->terpakai -= $transaksi->jumlah;
            $stok->sisa     += $transaksi->jumlah;
            $stok->save();

            $transaksi->delete();
        });

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi dihapus & stok dikembalikan');
    }

    public function cetakPdf()
    {
        $data = TransaksiBarang::with(['barang', 'titik_lokasi'])
            ->orderBy('tanggal', 'desc')
            ->get();

        $pdf = Pdf::loadView('transaksi_barang.pdf', [
            'data' => $data
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-barang-keluar.pdf');
    }
}
