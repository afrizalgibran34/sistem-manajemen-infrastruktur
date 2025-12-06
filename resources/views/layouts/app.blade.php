<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />

    <!-- Extra styles (opsional) -->
    @stack('styles')

</head>

<body>
    @php
    $activePage = $activePage ?? '';
    $activeButton = $activeButton ?? '';
    $navName = $navName ?? '';
@endphp


    <div class="wrapper @guest wrapper-full-page @endguest">

        {{-- Sidebar hanya muncul kalau user sudah login --}}
        @auth
            @include('layouts.navbars.sidebar')
        @endauth

        <div class="@auth main-panel @endauth">

            {{-- Navbar --}}
            @auth
                @include('layouts.navbars.navbar')
            @endauth

            <div class="content">
            <div class="container-fluid">
                {{-- Jika layout dipakai sebagai component (x-app-layout) pakai $slot,
                    jika dipakai sebagai classic layout pakai section('content') --}}
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>
        </div>

            {{-- Footer --}}
            @auth
                @include('layouts.footer.nav')
            @endauth

        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Light Bootstrap Dashboard control -->
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}"></script>

    <!-- Extra scripts -->
    @stack('scripts')

</body>

</html>
