<?php

namespace App\Http\Controllers;

use App\Models\Gangguan;
use App\Models\Wilayah;
use App\Models\JenisMasalah;
use App\Models\TitikLokasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GangguanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        // Query dengan filter
        $query = Gangguan::with(['titik', 'wilayah', 'jenis_masalah']);

        // Filter Wilayah
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }

        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        // Filter Status Masalah
        if ($request->filled('status_masalah')) {
            $query->where('status_masalah', $request->status_masalah);
        }

        // Filter Rentang Tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal', [$request->tanggal_dari, $request->tanggal_sampai]);
        } elseif ($request->filled('tanggal_dari')) {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        } elseif ($request->filled('tanggal_sampai')) {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        $data = $query->paginate($perPage)->appends($request->query());

        // Data untuk dropdown filter
        $wilayahList = Wilayah::all();
        $bulanList = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        return view('gangguan.index', compact('data', 'wilayahList', 'bulanList'));
    }

    public function create()
    {
        return view('gangguan.create', [
            'titik' => TitikLokasi::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_titik' => 'required',
            'id_jenismasalah' => 'required',
        ]);

        $titik = TitikLokasi::findOrFail($request->id_titik);

        Gangguan::create([
            'tanggal' => $request->tanggal,
            'bulan' => date('F', strtotime($request->tanggal)),
            'id_titik' => $request->id_titik,
            'id_wilayah' => $titik->id_wilayah,
            'fo_wireless' => $titik->koneksi,
            'id_jenismasalah' => $request->id_jenismasalah,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'jumlah_kunjungan' => $request->jumlah_kunjungan ?? 0,
            'status_masalah' => $request->status_masalah,
        ]);

        return redirect()->route('gangguan.index');
    }

    public function edit($id)
    {
        return view('gangguan.edit', [
            'data' => Gangguan::findOrFail($id),
            'titik' => TitikLokasi::all(),
            'jenis_masalah' => JenisMasalah::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Gangguan::findOrFail($id);
        $titik = TitikLokasi::findOrFail($request->id_titik);

        $data->update([
            'tanggal' => $request->tanggal,
            'bulan' => date('F', strtotime($request->tanggal)),
            'id_titik' => $request->id_titik,
            'id_wilayah' => $titik->id_wilayah,
            'fo_wireless' => $titik->koneksi,
            'id_jenismasalah' => $request->id_jenismasalah,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'jumlah_kunjungan' => $request->jumlah_kunjungan ?? 0,
            'status_masalah' => $request->status_masalah,
        ]);

        return redirect()->route('gangguan.index');
    }

    public function destroy($id)
    {
        Gangguan::findOrFail($id)->delete();
        return redirect()->route('gangguan.index');
    }

    public function exportPdf(Request $request)
    {
        // Query dengan filter yang sama seperti index
        $query = Gangguan::with([
            'wilayah',
            'jenis_masalah',
            'titik'
        ]);

        // Filter Wilayah
        if ($request->filled('id_wilayah')) {
            $query->where('id_wilayah', $request->id_wilayah);
        }

        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        // Filter Status Masalah
        if ($request->filled('status_masalah')) {
            $query->where('status_masalah', $request->status_masalah);
        }

        // Filter Rentang Tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal', [$request->tanggal_dari, $request->tanggal_sampai]);
        } elseif ($request->filled('tanggal_dari')) {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        } elseif ($request->filled('tanggal_sampai')) {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        $data = $query->orderBy('tanggal', 'asc')->get();

        // Data filter untuk ditampilkan di PDF
        $filters = [
            'wilayah' => $request->filled('id_wilayah') ? Wilayah::find($request->id_wilayah)->nama_wilayah ?? '' : null,
            'bulan' => $request->bulan,
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
        ];

        $pdf = Pdf::loadView('gangguan.pdf', compact('data', 'filters'))
                ->setPaper('A4', 'landscape');

        // Tambahkan nomor halaman
        $pdf->getDomPDF()->setCallbacks([
            'pages' => function ($page, $canvas, $fontMetrics) {
                $text = "Hal {$page->get_page_number()} dari {$canvas->get_page_count()}";
                $font = $fontMetrics->get_font("sans-serif");
                $size = 8;
                $width = $canvas->get_width();
                $height = $canvas->get_height();
                $x = $width - 100;
                $y = $height - 20;
                $canvas->text($x, $y, $text, $font, $size);
            }
        ]);

        return $pdf->stream('laporan-gangguan-jaringan.pdf');
    }

}
