@extends('layouts.app', [
    'activePage' => 'perangkat',
    'title' => __('Tambah Perangkat'),
    'navName' => 'Perangkat',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Perangkat</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('perangkat.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Jenis Perangkat</label>
                        <input type="text" name="jenis_perangkat" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
