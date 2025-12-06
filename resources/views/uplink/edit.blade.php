@extends('layouts.app', [
    'activePage' => 'uplink',
    'title' => __('Edit Uplink'),
    'navName' => 'Uplink',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Uplink</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('uplink.update', $data->id_uplink) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Jenis Uplink</label>
                        <input type="text" name="jenis_uplink" value="{{ $data->jenis_uplink }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('uplink.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
