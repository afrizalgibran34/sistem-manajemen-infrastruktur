@extends('layouts.app', [
    'activePage' => 'transaksi_barang',
    'title' => __('Transaksi Barang'),
    'navName' => 'Transaksi Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ route('transaksi_barang.create') }}" class="btn btn-primary mb-3">
            + Tambah Transaksi
        </a>

        <div class="card strpied-tabled-with-hover">

            <div class="card-header">
                <h4 class="card-title">Data Transaksi Barang</h4>
                <p class="card-category">Catatan keluar/masuk barang per lokasi</p>
            </div>

            <div class="card-body table-full-width table-responsive">

                <table class="table table-hover table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->transaksi_id }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->keterangan }}</td>

                            <td class="text-center">

                                <a href="{{ route('transaksi_barang.edit', $row->transaksi_id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('transaksi_barang.destroy', $row->transaksi_id) }}"
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
