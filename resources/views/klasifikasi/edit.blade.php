@extends('layouts.app', [
    'activePage' => 'klasifikasi',
    'title' => __('Edit Klasifikasi'),
    'navName' => 'Klasifikasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Klasifikasi</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('klasifikasi.update', $data->id_klasifikasi) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Nama Klasifikasi</label>
                        <input type="text" name="klasifikasi" value="{{ $data->klasifikasi }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('klasifikasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
