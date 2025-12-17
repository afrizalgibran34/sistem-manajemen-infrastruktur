@extends('layouts.app', [
    'activePage' => 'users',
    'title' => __('Tambah User'),
    'navName' => 'Tambah User'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah User</h4>
                <p class="card-category">Tambah akun pengguna sistem</p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>
                    
                    <button class="btn btn-primary mt-2">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">
                        Kembali
                    </a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
