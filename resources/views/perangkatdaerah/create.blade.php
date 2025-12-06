@extends('layouts.app', [
    'activePage' => 'perangkatdaerah',
    'title' => __('Tambah Perangkat Daerah'),
    'navName' => 'Perangkat Daerah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Perangkat Daerah</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('perangkatdaerah.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Perangkat Daerah</label>
                        <input type="text" name="nama_perangkat" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('perangkatdaerah.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
