<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="font-sans antialiased">
    @php
    $activePage = $activePage ?? '';
    $activeButton = $activeButton ?? '';
    $navName = $navName ?? '';
    @endphp

    @auth
        @include('layouts.navbars.sidebar')

        <div class="fixed top-0 right-0 h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 z-[999] left-0 lg:left-60">
            <div class="flex items-center gap-3 flex-1">
            </div>
            
            <div class="flex items-center gap-3 lg:gap-5">
                <button class="text-gray-500 hover:text-gray-700 text-xl">
                    <i class="far fa-bell"></i>
                </button>
                
                <div class="relative">
                    <div class="flex items-center gap-3 cursor-pointer" onclick="toggleDropdown()">
                        <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <div class="w-9 h-9 rounded-full user-avatar-gradient text-white font-semibold text-sm flex items-center justify-center">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    
                    <div id="userDropdown" class="dropdown-menu">
                        <a href="/profile" class="px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 flex items-center no-underline">
                            <i class="fas fa-user w-5 mr-2 text-gray-500"></i>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 bg-transparent border-0">
                                <i class="fas fa-sign-out-alt w-5 mr-2 text-gray-500"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    @endauth

    <div class="@auth ml-0 lg:ml-60 mt-16 min-h-[calc(100vh-4rem)] bg-gray-100 p-4 lg:p-6 @else min-h-screen bg-gray-100 @endauth">
        @guest
            <div class="min-h-screen flex flex-col items-center pt-6 bg-gray-100">
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>
        @else
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        @endguest
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }
        
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userProfile = event.target.closest('[onclick="toggleDropdown()"]');
            
            if (!userProfile && dropdown && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
        
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
        
        function toggleSubmenu(button) {
            const submenu = button.nextElementSibling;
            const isActive = button.classList.contains('active');
            
            document.querySelectorAll('.menu-link.has-submenu').forEach(link => {
                if (link !== button) {
                    link.classList.remove('active');
                    link.nextElementSibling?.classList.remove('show');
                }
            });
            
            button.classList.toggle('active');
            submenu?.classList.toggle('show');
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const activeSubmenuLink = document.querySelector('.submenu-link.active');
            if (activeSubmenuLink) {
                const submenu = activeSubmenuLink.closest('.submenu');
                const menuLink = submenu?.previousElementSibling;
                if (menuLink) {
                    menuLink.classList.add('active');
                    submenu.classList.add('show');
                }
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
