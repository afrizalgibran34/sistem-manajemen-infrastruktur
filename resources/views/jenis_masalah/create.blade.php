@extends('layouts.app', [
    'activePage' => 'jenis_masalah',
    'title' => __('Tambah Jenis Masalah'),
    'navName' => 'Jenis Masalah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Jenis Masalah</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('jenis_masalah.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Masalah</label>
                        <input type="text" name="nama_masalah" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jenis_masalah.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
