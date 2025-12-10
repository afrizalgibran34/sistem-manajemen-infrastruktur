<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Mobile: solid background */
        .login-bg {
            background-color: #ffffff;
        }

        /* Desktop: image background */
        @media (min-width: 1024px) {
            .login-bg {
                background-image: url("{{ asset('assets/img/background-login.png') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-color: #1e3a5f;
            }
        }

        /* Dark mode mobile background */
        .dark-mode .login-bg {
            background-color: #111827;
        }

        @media (min-width: 1024px) {
            .dark-mode .login-bg {
                background-color: #1e3a5f;
            }
        }

        .theme-toggle {
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        input:focus {
            outline: none;
        }

        .refresh-icon {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .refresh-icon:hover {
            transform: rotate(180deg);
        }

        /* Light Mode Styles */
        .light-mode .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #1f2937;
        }

        .light-mode .input-field {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            color: #1f2937;
        }

        .light-mode .input-field::placeholder {
            color: #9ca3af;
        }

        .light-mode .input-field:focus {
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .light-mode .captcha-display {
            background: #f3f4f6;
            color: #1f2937;
        }

        .light-mode .label-text {
            color: #374151;
        }

        .light-mode .subtitle-text {
            color: #6b7280;
        }

        /* Dark Mode Styles */
        .dark-mode .login-card {
            background: transparent;
            backdrop-filter: none;
            
        }

        /* Desktop dark mode: transparent card */
        @media (min-width: 1024px) {
            .dark-mode .login-card {
                background: rgba(31, 41, 55, 0.95);
                backdrop-filter: blur(10px);
                color: #fff;
            }
        }

        .dark-mode .input-field {
            background: rgba(31, 41, 55, 0.5);
            border: 1px solid #4b5563;
            color: #f9fafb;
        }

        .dark-mode .input-field::placeholder {
            color: #9ca3af;
        }

        .dark-mode .input-field:focus {
            background: rgba(17, 24, 39, 0.7);
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3);
        }

        .dark-mode .captcha-display {
            background: rgba(31, 41, 55, 0.5);
            color: #f9fafb;
            border: 1px solid #4b5563;
        }

        .dark-mode .label-text {
            color: #f3f4f6;
        }

        .dark-mode .subtitle-text {
            color: #d1d5db;
        }

        .icon-input {
            padding-left: 2.75rem;
        }

        .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
            pointer-events: none;
            z-index: 10;
        }

        .light-mode .input-icon {
            color: #6b7280;
        }

        .dark-mode .input-icon {
            color: #f3f4f6;
            opacity: 0.8;
        }

        .password-toggle {
            position: absolute;
            right: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
            z-index: 10;
        }

        .password-toggle:hover {
            opacity: 1;
        }

        .light-mode .password-toggle {
            color: #6b7280;
        }

        .dark-mode .password-toggle {
            color: #f3f4f6;
        }
    </style>
</head>
<body class="light-mode" id="themeBody">
    <div class="min-h-screen login-bg flex flex-col lg:flex-row">
        <!-- Left Side - Branding -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-8 xl:p-12">
            <div class="text-white max-w-md">
                <h1 class="text-4xl xl:text-6xl font-bold mb-4">Nama app</h1>
                <p class="text-xl xl:text-2xl font-light">Aplikasi jaringan</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-6 lg:p-8">
            <div class="w-full max-w-md px-2 sm:px-0">
                <div class="login-card rounded-2xl p-6 sm:p-8 relative lg:shadow-2xl">
                    <!-- Theme Toggle Button -->
                    <button 
                        type="button" 
                        id="themeToggle" 
                        class="theme-toggle absolute top-6 right-6 p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-100"
                        onclick="toggleTheme()"
                    >
                        <!-- Sun Icon (shown in dark mode) -->
                        <svg id="sunIcon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                        <!-- Moon Icon (shown in light mode) -->
                        <svg id="moonIcon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="text-center mb-6 sm:mb-8">
                        <h2 class="text-2xl sm:text-3xl font-bold text-blue-600 mb-2">LOGIN</h2>
                        <p class="subtitle-text text-sm sm:text-base">Silakan masuk ke akun Anda</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username/Email -->
                        <div class="mb-4 sm:mb-5">
                            <label for="email" class="label-text block mb-2 text-sm font-medium">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus 
                                    autocomplete="username"
                                    placeholder="Masukkan username"
                                    class="input-field w-full pl-11 pr-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200"
                                />
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4 sm:mb-5">
                            <label for="password" class="label-text block mb-2 text-sm font-medium">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-5 h-5 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    class="input-field w-full pl-11 pr-12 py-2.5 sm:py-3 rounded-lg transition-all duration-200"
                                />
                                <!-- Password Toggle Icon -->
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility()"
                                    class="password-toggle"
                                    aria-label="Toggle password visibility"
                                >
                                    <!-- Eye Icon (show password) -->
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <!-- Eye Slash Icon (hide password) -->
                                    <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Captcha -->
                        <div class="mb-4 sm:mb-5">
                            <label class="label-text block mb-2 text-sm font-medium">Verifikasi Keamanan</label>
                            <div class="flex gap-2 mb-3">
                                <div class="captcha-display flex-1 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg text-center font-semibold text-base sm:text-lg">
                                    {{ session('captcha_question') }} = ?
                                </div>
                                <button 
                                    type="button" 
                                    onclick="window.location.reload()"
                                    class="p-2 sm:p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors flex items-center justify-center"
                                >
                                    <svg class="refresh-icon w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <input 
                                id="captcha" 
                                type="number" 
                                name="captcha" 
                                required
                                placeholder="Jawaban Anda"
                                class="input-field w-full px-4 py-2.5 sm:py-3 rounded-lg transition-all duration-200"
                            />
                            @error('captcha')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-5 sm:mb-6">
                            <label class="flex items-center cursor-pointer">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    name="remember"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                />
                                <span class="label-text ms-2 text-sm">Ingat saya</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 sm:py-3 rounded-lg transition-colors duration-200 shadow-lg text-sm sm:text-base"
                        >
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Detect system theme preference
        function getSystemTheme() {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                return 'dark';
            }
            return 'light';
        }

        // Initialize theme based on system preference
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            const theme = savedTheme || getSystemTheme();
            applyTheme(theme);
        }

        // Apply theme
        function applyTheme(theme) {
            const body = document.getElementById('themeBody');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');

            if (theme === 'dark') {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }

            localStorage.setItem('theme', theme);
        }

        // Toggle theme
        function toggleTheme() {
            const body = document.getElementById('themeBody');
            const currentTheme = body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                applyTheme(e.matches ? 'dark' : 'light');
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initTheme);
    </script>
</body>
</html>
