@extends('layouts.app', [
    'activePage' => 'koneksi',
    'title' => __('Edit Koneksi'),
    'navName' => 'Koneksi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Koneksi</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('koneksi.update', $data->id_koneksi) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Jenis Koneksi</label>
                        <input type="text" name="jenis_koneksi" value="{{ $data->jenis_koneksi }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('koneksi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
