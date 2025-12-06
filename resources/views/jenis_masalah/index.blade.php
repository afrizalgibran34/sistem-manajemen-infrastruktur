@extends('layouts.app', [
    'activePage' => 'jenis_masalah',
    'title' => __('Data Jenis Masalah'),
    'navName' => 'Jenis Masalah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('jenis_masalah.create') }}" class="btn btn-primary">
                    + Tambah Jenis Masalah
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Jenis Masalah</h4>
                        <p class="card-category">Daftar jenis masalah yang sering terjadi</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 60%;">Nama Masalah</th>
                                    <th style="width: 30%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_jenismasalah }}</td>
                                    <td>{{ $row->nama_masalah }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('jenis_masalah.edit', $row->id_jenismasalah) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('jenis_masalah.destroy', $row->id_jenismasalah) }}"
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
