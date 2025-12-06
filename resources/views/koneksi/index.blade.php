@extends('layouts.app', [
    'activePage' => 'koneksi',
    'title' => __('Data Koneksi'),
    'navName' => 'Koneksi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('koneksi.create') }}" class="btn btn-primary">
                    + Tambah Koneksi
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Koneksi</h4>
                        <p class="card-category">Jenis koneksi jaringan yang tersedia</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 60%;">Jenis Koneksi</th>
                                    <th style="width: 30%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_koneksi }}</td>
                                    <td>{{ $row->jenis_koneksi }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('koneksi.edit', $row->id_koneksi) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('koneksi.destroy', $row->id_koneksi) }}"
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
