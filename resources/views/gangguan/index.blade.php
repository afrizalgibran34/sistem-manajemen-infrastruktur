@extends('layouts.app', [
    'activePage' => 'gangguan',
    'title' => __('Laporan Gangguan Jaringan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('gangguan.create') }}" class="btn btn-primary">
                + Tambah Gangguan
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Laporan Gangguan Jaringan</h4>
                        <p class="card-category">Rekap semua gangguan berdasarkan titik layanan</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Tanggal</th>
                                    <th>Wilayah</th>
                                    <th>Titik / Lokasi Layanan</th>
                                    <th>FO / Wireless</th>
                                    <th>Jenis Masalah</th>
                                    <th>Keterangan</th>
                                    <th>Penanganan</th>
                                    <th>Jumlah Kunjungan</th>
                                    <th>Status Masalah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->bulan }}</td>
                                    <td>{{ $row->tanggal }}</td>
                                    <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $row->titik->nama_titik ?? '-' }}</td>
                                    <td>{{ $row->fo_wireless }}</td>
                                    <td>{{ $row->jenis_masalah->nama_masalah ?? '-' }}</td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                    <td>{{ $row->penanganan ?? '-' }}</td>
                                    <td>{{ $row->jumlah_kunjungan ?? 0 }}</td>
                                    <td>{{ $row->status_masalah }}</td>

                                    <td>
                                        <a href="{{ route('gangguan.edit', $row->id_gangguan) }}"
                                           class="btn btn-warning btn-sm mb-1">Edit</a>

                                        <form action="{{ route('gangguan.destroy', $row->id_gangguan) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus data ini?')"
                                                    class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
