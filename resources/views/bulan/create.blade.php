@extends('layouts.app', [
    'activePage' => 'bulan',
    'title' => __('Tambah Bulan'),
    'navName' => 'Bulan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Bulan</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('bulan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Bulan</label>
                        <input type="text" name="nama_bulan" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('bulan.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>

        </div>

    </div>
</div>
@endsection
