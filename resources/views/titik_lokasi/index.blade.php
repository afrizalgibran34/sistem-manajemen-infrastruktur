@extends('layouts.app', [
    'activePage' => 'titik_lokasi',
    'title' => __('Data Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">

            <a href="{{ route('titik_lokasi.create') }}" class="btn btn-primary">
                + Tambah Titik Lokasi
            </a>

            <a href="{{ route('titik_lokasi.exportPdf') }}" class="btn btn-danger">
                Export PDF
            </a>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Titik Lokasi</h4>
                        <p class="card-category">Semua titik lokasi jaringan</p>
                    </div>
<div class="card-body table-responsive">

    <table class="table table-hover table-striped align-middle text-start">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Titik</th>
                <th>Wilayah</th>
                <th>PD/Unit Kerja</th>
                <th>Klasifikasi Area</th>
                <th>Koneksi</th>
                <th>Status</th>
                <th>Backbone</th>
                <th>Uplink</th>
                <th>Perangkat</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
            <tr>
                <td class="align-top">{{ $row->id_titik }}</td>
                <td class="align-top">{{ $row->nama_titik }}</td>
                <td class="align-top">{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                <td class="align-top">{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
                <td class="align-top">{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
                <td class="align-top">{{ $row->koneksi ?? '-' }}</td>
                <td class="align-top">{{ $row->status ?? '-' }}</td>
                <td class="align-top text-wrap">{{ $row->backbone->jenis_backbone ?? '-' }}</td>
                <td class="align-top text-wrap">{{ $row->uplink->jenis_uplink ?? '-' }}</td>
                <td class="align-top text-wrap">{{ $row->perangkat ?? '-' }}</td>
                <td class="align-top text-wrap">{{ $row->keterangan ?? '-' }}</td>

                <td class="align-top">
                    <div class="d-flex flex-column gap-1">

                        <a href="{{ route('titik_lokasi.edit', $row->id_titik) }}"
                           class="btn btn-warning btn-sm mb-1 w-100">
                            Edit
                        </a>

                        <form action="{{ route('titik_lokasi.destroy', $row->id_titik) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus data ini?')"
                                    class="btn btn-danger btn-sm w-100">
                                Hapus
                            </button>
                        </form>

                    </div>
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
