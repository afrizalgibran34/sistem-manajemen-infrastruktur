@extends('layouts.app', [
    'activePage' => 'koneksi',
    'title' => __('Tambah Koneksi'),
    'navName' => 'Koneksi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Koneksi</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('koneksi.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Jenis Koneksi</label>
                        <input type="text" name="jenis_koneksi" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('koneksi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
