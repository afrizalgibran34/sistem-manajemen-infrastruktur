@extends('layouts.app', [
    'activePage' => 'wilayah',
    'title' => __('Edit Wilayah'),
    'navName' => 'Wilayah',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Wilayah</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('wilayah.update', $data->id_wilayah) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Nama Wilayah</label>
                        <input type="text" 
                               name="nama_wilayah" 
                               value="{{ $data->nama_wilayah }}" 
                               class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('wilayah.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
