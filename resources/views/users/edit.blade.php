@extends('layouts.app', [
    'activePage' => 'users',
    'title' => __('Edit User'),
    'navName' => 'Edit User'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit User</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text"
                               name="username"
                               value="{{ old('username', $user->username) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Password Baru (Opsional)</label>
                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control">
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
