@extends('layouts.app', [
    'activePage' => 'klasifikasi',
    'title' => __('Tambah Klasifikasi'),
    'navName' => 'Klasifikasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Klasifikasi</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('klasifikasi.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Klasifikasi <span style="color: red;">*</span></label>
                        <input type="text" name="klasifikasi" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('klasifikasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
