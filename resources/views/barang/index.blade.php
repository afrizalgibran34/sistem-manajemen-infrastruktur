@extends('layouts.app', [
    'activePage' => 'barang',
    'title' => __('Data Barang'),
    'navName' => 'Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>

        <div class="card strpied-tabled-with-hover">
            <div class="card-header">
                <h4 class="card-title">Data Barang</h4>
            </div>

            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->barang_id }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td>{{ $row->satuan }}</td>
                            <td class="text-center">

                                <a href="{{ route('barang.edit', $row->barang_id) }}" class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('barang.destroy', $row->barang_id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
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
