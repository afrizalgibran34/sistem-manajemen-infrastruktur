@extends('layouts.app', [
    'activePage' => 'titik_lokasi',
    'title' => __('Data Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('titik_lokasi.create') }}" class="btn btn-primary">
                    + Tambah Titik Lokasi
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Titik Lokasi</h4>
                        <p class="card-category">Semua titik lokasi jaringan</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Titik</th>
                                    <th>Wilayah</th>
                                    <th>Kec/Kel</th>
                                    <th>Klasifikasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_titik }}</td>
                                    <td>{{ $row->nama_titik }}</td>
                                    <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $row->kecKel->nama_kec_kel ?? '-' }}</td>
                                    <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
                                    <td>{{ $row->status->status ?? '-' }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('titik_lokasi.edit', $row->id_titik) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('titik_lokasi.destroy', $row->id_titik) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Yakin hapus data ini?')"
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
