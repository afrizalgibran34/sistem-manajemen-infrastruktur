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

            // 1️⃣ Simpan transaksi barang keluar
            TransaksiBarang::create([
                'tanggal'    => $request->tanggal,
                'lokasi_id'  => $request->lokasi_id,
                'barang_id'  => $request->barang_id,
                'jumlah'     => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            // 2️⃣ Ambil stok barang
            $stok = StokBarang::where('barang_id', $request->barang_id)->firstOrFail();

            // 3️⃣ Validasi stok cukup
            if ($stok->sisa < $request->jumlah) {
                abort(400, 'Stok barang tidak mencukupi');
            }

            // 4️⃣ Update stok otomatis
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

        // ⚠️ Catatan:
        // Update TIDAK mengubah stok otomatis
        // (biar aman & konsisten)

        TransaksiBarang::findOrFail($id)->update([
            'tanggal'    => $request->tanggal,
            'lokasi_id'  => $request->lokasi_id,
            'barang_id'  => $request->barang_id,
            'jumlah'     => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi barang berhasil diupdate');
    }

    public function destroy($id)
    {
        // ⚠️ Catatan:
        // Hapus transaksi TIDAK mengembalikan stok
        // (bisa ditambahkan kalau kamu mau)

        TransaksiBarang::findOrFail($id)->delete();

        return redirect()
            ->route('transaksi_barang.index')
            ->with('success', 'Transaksi barang berhasil dihapus');
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
