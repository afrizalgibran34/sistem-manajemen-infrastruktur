@extends('layouts.app', [
    'activePage' => 'jenis_masalah',
    'title' => __('Edit Jenis Masalah'),
    'navName' => 'Jenis Masalah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Jenis Masalah</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('jenis_masalah.update', $data->id_jenismasalah) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Nama Masalah</label>
                        <input type="text" name="nama_masalah" value="{{ $data->nama_masalah }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('jenis_masalah.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
