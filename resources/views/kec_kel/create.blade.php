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

                    <div class="form-group mb-3">
                        <label>Nama Kec/Kel <span style="color: red;">*</span></label>
                        <input type="text" name="nama_kec_kel" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kec_kel.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
