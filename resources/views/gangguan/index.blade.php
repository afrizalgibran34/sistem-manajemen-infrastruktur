@extends('layouts.app', [
    'activePage' => 'gangguan',
    'title' => __('Data Gangguan Jaringan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('gangguan.create') }}" class="btn btn-primary">
                    + Tambah Gangguan
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Gangguan</h4>
                        <p class="card-category">Laporan gangguan jaringan dari berbagai daerah</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Wilayah</th>
                                    <th>Perangkat</th>
                                    <th>Jenis Masalah</th>
                                    <th>Jaringan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_gangguan }}</td>
                                    <td>{{ $row->tanggal }}</td>
                                    <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $row->perangkat->nama_perangkat ?? '-' }}</td>
                                    <td>{{ $row->jenisMasalah->nama_masalah ?? '-' }}</td>
                                    <td>{{ $row->FO_wireless }}</td>

                                    <td class="text-center">

                                        <a href="{{ route('gangguan.edit', $row->id_gangguan) }}" 
                                           class="btn btn-warning btn-sm mr-2">Edit</a>

                                        <form action="{{ route('gangguan.destroy', $row->id_gangguan) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Hapus data gangguan ini?')"
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
