@extends('layouts.app', [
    'activePage' => 'wilayah',
    'title' => __('Tambah Wilayah'),
    'navName' => 'Wilayah',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Wilayah</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('wilayah.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Wilayah <span style="color: red;">*</span></label>
                        <input type="text" name="nama_wilayah" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('wilayah.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
