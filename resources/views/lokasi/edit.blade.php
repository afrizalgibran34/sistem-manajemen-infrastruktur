@extends('layouts.app', [
    'activePage' => 'lokasi',
    'title' => __('Edit Lokasi'),
    'navName' => 'Lokasi',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Lokasi</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('lokasi.update', $data->lokasi_id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama Lokasi</label>
                        <input type="text" name="nama_lokasi"
                               value="{{ $data->nama_lokasi }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
