@extends('layouts.app', [
    'activePage' => 'perangkatdaerah',
    'title' => __('Data Perangkat Daerah'),
    'navName' => 'Perangkat Daerah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('perangkatdaerah.create') }}" class="btn btn-primary">
                    + Tambah Perangkat Daerah
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Perangkat Daerah</h4>
                        <p class="card-category">Daftar perangkat daerah yang terdaftar</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 60%;">Nama Perangkat Daerah</th>
                                    <th style="width: 30%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_perangkat }}</td>
                                    <td>{{ $row->nama_perangkat }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('perangkatdaerah.edit', $row->id_perangkat) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('perangkatdaerah.destroy', $row->id_perangkat) }}"
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
