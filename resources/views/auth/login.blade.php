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
                    background-color: #ffffff;
                }
                
                .left-panel {
                    background-image: url('/assets/img/background-login.png');
                    background-size: cover;
                    background-position: center;
                    position: relative;
                }
                
                .left-panel::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.3);
                }
                
                .left-panel-content {
                    position: relative;
                    z-index: 1;
                }
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

            .login-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                color: #1f2937;
            }

            .input-field {
                background: #f3f4f6;
                border: 1px solid #e5e7eb;
                color: #1f2937;
            }

            .input-field::placeholder {
                color: #9ca3af;
            }

            .input-field:focus {
                background: #ffffff;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            .captcha-display {
                background: #f3f4f6;
                color: #1f2937;
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
                color: #6b7280;
            }

            .password-toggle:hover {
                opacity: 1;
            }

            .captcha-refresh {
                cursor: pointer;
                opacity: 0.6;
                transition: all 0.2s;
                color: #6b7280;
                padding: 0.5rem;
                border-radius: 0.375rem;
                background: #f3f4f6;
                border: 1px solid #e5e7eb;
            }

            .captcha-refresh:hover {
                opacity: 1;
                background-color: #e5e7eb;
                transform: scale(1.05);
            }

            .captcha-refresh:active {
                transform: scale(0.95);
            }

            /* Hide desktop-only icons on mobile */
            @media (max-width: 1023px) {
                .desktop-icon {
                    display: none !important;
                }
            }

            /* Hide mobile-only content on desktop */
            @media (min-width: 1024px) {
                .mobile-only {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body>
        <div class="min-h-screen login-bg">
            <!-- Mobile View -->
            <div class="lg:hidden flex items-center justify-center p-4 sm:p-6 min-h-screen">
                <div class="w-full max-w-md px-2 sm:px-0">
                    <div class="login-card rounded-2xl p-6 sm:p-8 relative">
                        <div class="text-center mb-6 sm:mb-8">
                            <h2 class="text-2xl sm:text-3xl font-bold text-blue-600 mb-2">
                                LOGIN
                            </h2>
                            <p class="subtitle-text text-sm sm:text-base">
                                Silakan masuk ke akun Anda
                            </p>
                        </div>

                        <!-- Form container for mobile - form will be inserted here -->
                        <div id="mobile-form-container"></div>
                    </div>
                </div>
            </div>

            <!-- Desktop View -->
            <div class="hidden lg:grid lg:grid-cols-[55%_45%] min-h-screen">
                <!-- Left Panel -->
                <div class="left-panel flex items-center justify-center p-12">
                    <div class="left-panel-content text-center text-white">
                        <img src="/assets/img/logo-kota-bogor.png" alt="Logo Kota Bogor" class="w-24 h-28 mx-auto mb-8">
                        <h1 class="text-4xl font-bold mb-4">Sistem Manajemen<br>Aset Infrastruktur</h1>
                    </div>
                </div>

                <!-- Right Panel -->
                <div class="flex items-center justify-center p-12 bg-white">
                    <div class="w-full max-w-md">
                        <div class="mb-8 text-center">
                            <h2 class="text-4xl font-bold text-blue-600 mb-2">LOGIN</h2>
                            <p class="text-gray-600">Silakan masuk ke akun Anda</p>
                        </div>

                        <!-- Form container for desktop - form will be inserted here -->
                        <div id="desktop-form-container"></div>
                    </div>
                </div>
            </div>

            <!-- Single Login Form (hidden, will be moved to appropriate container) -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" style="display: none;">
                @csrf

                <!-- Username -->
                <div class="mb-4 sm:mb-5 lg:mb-5" id="username-field">
                    <label class="label-text block mb-2 text-sm font-medium lg:text-gray-700">Username</label>
                    <div class="relative">
                        <span class="desktop-icon absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            required
                            autofocus
                            class="input-field w-full px-4 py-2.5 rounded-lg lg:pl-12 lg:py-3 text-sm"
                            placeholder="Masukkan username"
                        />
                    </div>
                    @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4 sm:mb-5 lg:mb-5" id="password-field">
                    <label class="label-text block mb-2 text-sm font-medium lg:text-gray-700">Password</label>
                    <div class="relative">
                        <span class="desktop-icon absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="input-field w-full px-4 py-2.5 pr-12 rounded-lg lg:pl-12 lg:py-3"
                            placeholder="Masukkan password"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility()"
                            class="password-toggle"
                            aria-label="Toggle password visibility"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Captcha -->
                <div class="mb-4 sm:mb-5 lg:mb-6" id="captcha-field">
                    <label class="label-text block mb-2 text-sm font-medium lg:text-gray-700">
                        <span class="mobile-only">Verifikasi</span>
                        <span class="desktop-icon">Verifikasi Keamanan</span>
                    </label>
                    <div class="flex gap-2 mb-3">
                        <div class="captcha-display flex-1 px-4 py-3 text-center rounded-lg font-semibold lg:text-lg">
                            {{ session("captcha_question") }} = ?
                        </div>
                        <button 
                            type="button" 
                            onclick="refreshCaptcha()"
                            class="captcha-refresh flex items-center justify-center w-12 h-12"
                            aria-label="Refresh captcha"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    <input
                        id="captcha"
                        type="number"
                        name="captcha"
                        required
                        class="input-field w-full px-4 py-2.5 rounded-lg lg:py-3"
                        placeholder="Jawaban Anda"
                    />
                    @error('captcha')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg lg:py-3.5 transition-colors"
                >
                    Masuk
                </button>
            </form>
        </div>

        <script>
            // Move form to appropriate container based on screen size
            function moveForm() {
                const form = document.getElementById('loginForm');
                const mobileContainer = document.getElementById('mobile-form-container');
                const desktopContainer = document.getElementById('desktop-form-container');
                
                if (window.innerWidth >= 1024) {
                    // Desktop view
                    if (desktopContainer && !desktopContainer.contains(form)) {
                        desktopContainer.appendChild(form);
                        form.style.display = 'block';
                    }
                } else {
                    // Mobile view
                    if (mobileContainer && !mobileContainer.contains(form)) {
                        mobileContainer.appendChild(form);
                        form.style.display = 'block';
                    }
                }
            }

            // Run on page load
            moveForm();

            // Run on window resize
            window.addEventListener('resize', moveForm);

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

            // Refresh captcha dynamically
            function refreshCaptcha() {
                const button = window.event.target.closest('button');
                
                // Prevent multiple clicks
                if (button.disabled) return;
                
                const originalIcon = button.innerHTML;
                
                // Show loading state
                button.innerHTML = `
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;
                button.disabled = true;

                fetch('/captcha/refresh', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update the captcha display
                    const captchaDisplay = document.querySelector('.captcha-display');
                    captchaDisplay.textContent = data.question + ' = ?';
                    
                    // Add success animation
                    captchaDisplay.style.transition = 'all 0.3s ease';
                    captchaDisplay.style.transform = 'scale(1.05)';
                    captchaDisplay.style.backgroundColor = '#dcfce7'; // light green
                    
                    setTimeout(() => {
                        captchaDisplay.style.transform = 'scale(1)';
                        captchaDisplay.style.backgroundColor = '';
                    }, 300);
                    
                    // Clear the input field
                    document.getElementById('captcha').value = '';
                })
                .catch(error => {
                    console.error('Error refreshing captcha:', error);
                    // Show error message
                    const captchaSection = document.getElementById('captcha-field');
                    let errorMsg = captchaSection.querySelector('.captcha-error-msg');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-2 text-sm text-red-600 captcha-error-msg';
                        errorMsg.textContent = 'Gagal memuat captcha baru. Silakan coba lagi.';
                        captchaSection.appendChild(errorMsg);
                        
                        // Remove error message after 3 seconds
                        setTimeout(() => {
                            if (errorMsg.parentNode) {
                                errorMsg.remove();
                            }
                        }, 3000);
                    }
                })
                .finally(() => {
                    // Restore original button state
                    button.innerHTML = originalIcon;
                    button.disabled = false;
                });
            }
        </script>
    </body>
</html>