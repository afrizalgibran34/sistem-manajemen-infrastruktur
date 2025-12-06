@extends('layouts.app', [
    'activePage' => 'status',
    'title' => __('Edit Status'),
    'navName' => 'Status',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Status</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('status.update', $data->id_status) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status" value="{{ $data->status }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('status.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
