@extends('layouts.app', [
    'activePage' => 'bulan',
    'title' => __('Edit Bulan'),
    'navName' => 'Bulan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Bulan</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('bulan.update', $data->id_bulan) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Nama Bulan</label>
                        <input type="text" name="nama_bulan" value="{{ $data->nama_bulan }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('bulan.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>

        </div>

    </div>
</div>
@endsection
