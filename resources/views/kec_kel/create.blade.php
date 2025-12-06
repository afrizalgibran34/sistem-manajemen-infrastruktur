@extends('layouts.app', [
    'activePage' => 'kec_kel',
    'title' => __('Tambah Kec/Kel'),
    'navName' => 'Kec Kel',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Kec/Kel</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('kec_kel.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Kec/Kel</label>
                        <input type="text" name="nama_kec_kel" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kec_kel.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
