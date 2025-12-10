@extends('layouts.app', [
    'activePage' => 'profile',
    'title' => __('Profil Pengguna'),
    'navName' => 'Profil',
    'activeButton' => 'profile'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Judul Halaman --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <h3 class="text-dark font-weight-bold">Pengaturan Profil</h3>
                <p class="text-muted">Kelola informasi akun dan keamanan Anda</p>
            </div>
        </div>

        <div class="row">

            {{-- Update Biodata --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Pengguna</h5>
                    </div>

                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ganti Password</h5>
                    </div>

                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            

        </div>

    </div>
</div>
@endsection
