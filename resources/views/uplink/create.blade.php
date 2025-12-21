@extends('layouts.app', [
    'activePage' => 'uplink',
    'title' => __('Tambah Uplink'),
    'navName' => 'Uplink',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Uplink</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('uplink.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Jenis Uplink <span style="color: red;">*</span></label>
                        <input type="text" name="jenis_uplink" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('uplink.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
