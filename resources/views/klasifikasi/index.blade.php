@extends('layouts.app', [
    'activePage' => 'klasifikasi',
    'title' => __('Data Klasifikasi'),
    'navName' => 'Klasifikasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('klasifikasi.create') }}" class="btn btn-primary">
                    + Tambah Klasifikasi
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Klasifikasi</h4>
                        <p class="card-category">Daftar klasifikasi jaringan</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align:center;">ID</th>
                                    <th style="width: 60%; text-align:center;">Nama Klasifikasi</th>
                                    <th style="width: 30%; text-align:center;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_klasifikasi }}</td>
                                    <td>{{ $row->klasifikasi }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('klasifikasi.edit', $row->id_klasifikasi) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('klasifikasi.destroy', $row->id_klasifikasi) }}"
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
