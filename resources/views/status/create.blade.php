@extends('layouts.app', [
    'activePage' => 'status',
    'title' => __('Tambah Status'),
    'navName' => 'Status',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Status</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('status.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('status.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
