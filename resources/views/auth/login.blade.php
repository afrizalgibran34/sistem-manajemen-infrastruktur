@extends('layouts.app', [
    'activePage' => 'login',
    'title' => 'Login - Sistem Manajemen Aset Infrastruktur'
])

@section('content')
<style>
    .login-bg {
        background: linear-gradient(135deg, #7F56D9, #9E77ED);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
    }

    .login-card {
        background: white;
        border-radius: 12px;
        padding: 40px 35px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        animation: fadeIn 0.6s ease;
    }

    .login-title {
        font-weight: 700;
        font-size: 22px;
        color: #4A4A4A;
        text-align: center;
        margin-bottom: 10px;
    }

    .login-subtitle {
        color: #7F56D9;
        font-size: 14px;
        letter-spacing: 0.5px;
        text-align: center;
        margin-bottom: 25px;
    }

    .btn-login {
        width: 100%;
        background-color: #7F56D9;
        color: white;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: 600;
        font-size: 15px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background-color: #6B46C1;
        color: white;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

<div class="login-bg">

    <div class="login-card">

        <h2 class="login-title">Sistem Manajemen Aset Infrastruktur</h2>
        <p class="login-subtitle">Masuk ke akun Anda</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="form-group">
                <label>Username</label>
                <input type="text"
                       class="form-control @error('username') is-invalid @enderror"
                       name="username"
                       value="{{ old('username') }}"
                       required autofocus>
                @error('username')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       required>
                @error('password')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- CAPTCHA --}}
            <div class="form-group mt-3">
                <label>Captcha: <strong>{{ session('captcha_question') }}</strong></label>
                <input type="number"
                       class="form-control @error('captcha') is-invalid @enderror"
                       name="captcha"
                       required
                       placeholder="Masukkan jawaban">
                @error('captcha')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror
            </div>

            {{-- BUTTON --}}
            <button type="submit" class="btn btn-login mt-4">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
