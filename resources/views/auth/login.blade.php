<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config("app.name", "Laravel") }} - Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");

            * {
                font-family: "Inter", sans-serif;
            }

            .login-bg {
                background-color: #ffffff;
            }

            @media (min-width: 1024px) {
                .login-bg {
                    background-image: url("{{ asset('assets/img/background-login.png') }}");
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-color: #1e3a5f;
                }
            }

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

            .dark-mode .login-card {
                background: rgba(31, 41, 55, 0.95);
                backdrop-filter: blur(10px);
                color: #fff;
            }

            .dark-mode .input-field {
                background: rgba(31, 41, 55, 0.5);
                border: 1px solid #4b5563;
                color: #f9fafb;
            }

            .dark-mode .input-field::placeholder {
                color: #9ca3af;
            }

            .dark-mode .captcha-display {
                background: rgba(31, 41, 55, 0.5);
                color: #f9fafb;
                border: 1px solid #4b5563;
            }
        </style>
    </head>

    <body class="light-mode" id="themeBody">
        <div class="min-h-screen login-bg flex flex-col lg:flex-row">
            <!-- Left side -->
            <div
                class="hidden lg:flex lg:w-1/2 items-center justify-center p-8 xl:p-12"
            >
                <div class="text-white max-w-md">
                    <h1 class="text-4xl xl:text-6xl font-bold mb-4">
                        Nama app
                    </h1>
                    <p class="text-xl xl:text-2xl font-light">
                        Aplikasi jaringan
                    </p>
                </div>
            </div>

            <!-- Right side = Login form -->
            <div
                class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-6 lg:p-8"
            >
                <div class="w-full max-w-md px-2 sm:px-0">
                    <div
                        class="login-card rounded-2xl p-6 sm:p-8 relative lg:shadow-2xl"
                    >
                        <!-- Theme Toggle -->
                        <button
                            type="button"
                            id="themeToggle"
                            class="theme-toggle absolute top-6 right-6 p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-100"
                            onclick="toggleTheme()"
                        >
                            <svg
                                id="sunIcon"
                                class="w-6 h-6 hidden"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1..."
                                />
                            </svg>

                            <svg
                                id="moonIcon"
                                class="w-6 h-6"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path d="M17.293 13.293A8 8 0 016.707..." />
                            </svg>
                        </button>

                        <div class="text-center mb-6 sm:mb-8">
                            <h2
                                class="text-2xl sm:text-3xl font-bold text-blue-600 mb-2"
                            >
                                LOGIN
                            </h2>
                            <p class="subtitle-text text-sm sm:text-base">
                                Silakan masuk ke akun Anda
                            </p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Username -->
                            <div class="mb-4 sm:mb-5">
                                <label
                                    class="label-text block mb-2 text-sm font-medium"
                                    >Username</label
                                >
                                <input
                                    type="text"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                    autofocus
                                    class="input-field w-full px-4 py-2.5 rounded-lg"
                                    placeholder="Masukkan username"
                                />
                                @error('username')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4 sm:mb-5">
                                <label
                                    class="label-text block mb-2 text-sm font-medium"
                                    >Password</label
                                >
                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="input-field w-full px-4 py-2.5 rounded-lg"
                                    placeholder="Masukkan password"
                                />
                            </div>

                            <!-- Captcha -->
                            <div class="mb-4 sm:mb-5">
                                <label
                                    class="label-text block mb-2 text-sm font-medium"
                                    >Verifikasi</label
                                >
                                <div
                                    class="captcha-display px-4 py-3 text-center rounded-lg font-semibold mb-3"
                                >
                                    {{ session("captcha_question") }} = ?
                                </div>
                                <input
                                    type="number"
                                    name="captcha"
                                    required
                                    class="input-field w-full px-4 py-2.5 rounded-lg"
                                    placeholder="Jawaban Anda"
                                />
                            </div>

                            <!-- Submit Button -->
                            <button
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg"
                            >
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function toggleTheme() {
                const body = document.getElementById("themeBody");
                body.classList.toggle("dark-mode");
            }
        </script>
    </body>
</html>
