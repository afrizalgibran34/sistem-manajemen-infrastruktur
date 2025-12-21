@extends('layouts.app', [
    'activePage' => 'lokasi',
    'title' => __('Tambah Lokasi'),
    'navName' => 'Lokasi',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Lokasi</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('lokasi.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Lokasi <span style="color: red;">*</span></label>
                        <input type="text" name="nama_lokasi" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
