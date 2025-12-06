@extends('layouts.app', [
    'activePage' => 'stok_barang',
    'title' => __('Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ route('stok_barang.create') }}" class="btn btn-primary mb-3">+ Tambah Stok Barang</a>

        <div class="card strpied-tabled-with-hover">

            <div class="card-header">
                <h4 class="card-title">Data Stok Barang</h4>
                <p class="card-category">Daftar stok barang beserta pemakaian & sisa</p>
            </div>

            <div class="card-body table-full-width table-responsive">

                <table class="table table-hover table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Kuantitas</th>
                            <th>Terpakai</th>
                            <th>Sisa</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->stok_id }}</td>
                            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $row->kuantitas }}</td>
                            <td>{{ $row->terpakai }}</td>
                            <td>{{ $row->sisa }}</td>
                            <td>{{ $row->keterangan }}</td>

                            <td class="text-center">
                                <a href="{{ route('stok_barang.edit', $row->stok_id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('stok_barang.destroy', $row->stok_id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf @method('DELETE')
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
@endsection
