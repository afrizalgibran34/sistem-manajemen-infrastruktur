@extends('layouts.app', [
    'activePage' => 'backbone',
    'title' => __('Edit Backbone'),
    'navName' => 'Backbone',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Backbone</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('backbone.update', $data->id_backbone) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Jenis Backbone</label>
                        <input type="text" name="jenis_backbone" value="{{ $data->jenis_backbone }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('backbone.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
