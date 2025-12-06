@extends('layouts.app', [
    'activePage' => 'wilayah',
    'title' => __('Data Wilayah'),
    'navName' => 'Wilayah',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- TOMBOL TAMBAH --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('wilayah.create') }}" class="btn btn-primary">
                    + Tambah Wilayah
                </a>
            </div>
        </div>

        {{-- TABLE WILAYAH --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    
                    <div class="card-header">
                        <h4 class="card-title">Data Wilayah</h4>
                        <p class="card-category">Daftar seluruh wilayah yang tersedia</p>
                    </div>

                    <div class="card-body table-full-width table-responsive">
    <table class="table table-hover table-striped text-center align-middle">
        <thead>
            <th width="80">ID</th>
            <th class="text-center">Nama Wilayah</th>
            <th width="180">Aksi</th>
        </thead>

        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->id_wilayah }}</td>
                <td>{{ $row->nama_wilayah }}</td>
                <td>
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('wilayah.edit', $row->id_wilayah) }}" 
                           class="btn btn-warning btn-sm mr-3">
                            Edit
                        </a>

                        <form action="{{ route('wilayah.destroy', $row->id_wilayah) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus wilayah ini?')" 
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>

                    </div>
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
