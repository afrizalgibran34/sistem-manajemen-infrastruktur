@extends('layouts.app', [
    'activePage' => 'lokasi',
    'title' => __('Data Lokasi'),
    'navName' => 'Lokasi',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ route('lokasi.create') }}" class="btn btn-primary mb-3">+ Tambah Lokasi</a>

        <div class="card strpied-tabled-with-hover">
            <div class="card-header">
                <h4 class="card-title">Data Lokasi</h4>
                <p class="card-category">Daftar lokasi penyimpanan/penggunaan barang</p>
            </div>

            <div class="card-body table-full-width table-responsive">

                <table class="table table-hover table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->lokasi_id }}</td>
                            <td>{{ $row->nama_lokasi }}</td>

                            <td class="text-center">
                                <a href="{{ route('lokasi.edit', $row->lokasi_id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('lokasi.destroy', $row->lokasi_id) }}"
                                      method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">Hapus</button>
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
@endsection
