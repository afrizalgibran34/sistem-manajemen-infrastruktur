@extends('layouts.app', [
    'activePage' => 'perangkat',
    'title' => __('Edit Perangkat'),
    'navName' => 'Perangkat',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Perangkat</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('perangkat.update', $data->id_perangkat) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Jenis Perangkat</label>
                        <input type="text" name="jenis_perangkat" value="{{ $data->jenis_perangkat }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('perangkat.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
