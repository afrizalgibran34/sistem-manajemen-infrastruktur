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
                    <div class="input-group">
                        <input type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" data-target="password" style="cursor:pointer">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>


                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" data-target="password_confirmation" style="cursor:pointer">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-password').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>
@endpush
