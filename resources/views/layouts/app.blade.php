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

    <!-- Bootstrap CSS for existing views -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Extra styles (opsional) -->
    @stack('styles')
    
    <style>
        /* Custom gradient untuk sidebar - tidak bisa digantikan Tailwind */
        .sidebar-gradient {
            background: linear-gradient(180deg, #5b7cef 0%, #4a5fd8 50%, #3a4bc1 100%);
        }
        
        /* Sidebar mobile behavior */
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.show {
            transform: translateX(0);
        }
        
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0) !important;
            }
        }
        
        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
        
        /* Custom scrollbar untuk sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        
        /* Submenu transitions */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .submenu.show {
            max-height: 500px;
        }
        
        /* Dropdown arrow animation */
        .menu-link.has-submenu::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            transition: transform 0.2s ease;
        }
        
        .menu-link.has-submenu.active::after {
            transform: rotate(180deg);
        }
        
        /* User avatar gradient - tidak bisa digantikan Tailwind */
        .user-avatar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            min-width: 12rem;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 1050;
        }
        
        .dropdown-menu.show {
            display: block;
        
    </style>

</head>

<body class="font-sans antialiased">
    @php
    $activePage = $activePage ?? '';
    $activeButton = $activeButton ?? '';
    $navName = $navName ?? '';
    @endphp

    @auth
        <!-- Sidebar -->
        @include('layouts.navbars.sidebar')
        
        <!-- Top Navbar -->
        <div class="fixed top-0 right-0 h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 z-[999] transition-all duration-300 left-0 lg:left-60">
            <div class="flex items-center gap-3 flex-1">
                <!-- Mobile Menu Toggle -->
                <button class="lg:hidden w-10 h-10 flex items-center justify-center text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors" onclick="toggleSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div class="flex-1 max-w-xs lg:max-w-md mr-3">
                    <input type="text" placeholder="Search for..." class="w-full px-4 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                </div>
            </div>
            
            <div class="flex items-center gap-3 lg:gap-5">
                <button class="relative bg-transparent border-0 text-gray-500 hover:text-gray-700 cursor-pointer text-xl transition-colors">
                    <i class="far fa-bell"></i>
                </button>
                
                <button class="relative bg-transparent border-0 text-gray-500 hover:text-gray-700 cursor-pointer text-xl transition-colors">
                    <i class="far fa-envelope"></i>
                </button>
                
                <div class="relative">
                    <div class="flex items-center gap-3 cursor-pointer" onclick="toggleDropdown()">
                        <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <div class="w-9 h-9 rounded-full user-avatar-gradient flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    
                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="dropdown-menu">
                        <a href="/profile" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 no-underline transition-colors">
                            <i class="fas fa-user w-5 mr-2 text-gray-500"></i>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 border-0 bg-transparent cursor-pointer transition-colors">
                                <i class="fas fa-sign-out-alt w-5 mr-2 text-gray-500"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    @endauth

    <!-- Main Content -->
    <div class="@auth ml-0 lg:ml-60 mt-16 min-h-[calc(100vh-4rem)] bg-gray-100 transition-all duration-300 @else min-h-screen bg-gray-100 @endauth">
        @guest
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                {{-- Guest content --}}
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </div>
        @else
            {{-- Authenticated content --}}
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        @endguest
    </div>

    <!-- Bootstrap JS for existing views -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle user dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userProfile = event.target.closest('[onclick="toggleDropdown()"]');
            
            if (!userProfile && dropdown && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
        
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
        
        // Toggle submenu
        function toggleSubmenu(button) {
            const submenu = button.nextElementSibling;
            const isActive = button.classList.contains('active');
            
            // Close all other submenus
            document.querySelectorAll('.menu-link.has-submenu').forEach(link => {
                if (link !== button) {
                    link.classList.remove('active');
                    link.nextElementSibling?.classList.remove('show');
                }
            });
            
            // Toggle current submenu
            button.classList.toggle('active');
            submenu?.classList.toggle('show');
        }
        
        // Keep submenu open if a child is active
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

    <!-- Extra scripts -->
    @stack('scripts')

</body>

</html>
