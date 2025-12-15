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
        </style>
    </head>

    <body>
        <div class="min-h-screen login-bg flex items-center justify-center p-4 sm:p-6 lg:p-8">
                <div class="w-full max-w-md px-2 sm:px-0">
                    <div
                        class="login-card rounded-2xl p-6 sm:p-8 relative lg:shadow-2xl"
                    >

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
                                <div class="relative">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        class="input-field w-full px-4 py-2.5 pr-12 rounded-lg"
                                        placeholder="Masukkan password"
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
                            </div>

                            <!-- Captcha -->
                            <div class="mb-4 sm:mb-5">
                                <label
                                    class="label-text block mb-2 text-sm font-medium"
                                    >Verifikasi</label
                                >
                                <div class="flex gap-2 mb-3">
                                    <div
                                        class="captcha-display flex-1 px-4 py-3 text-center rounded-lg font-semibold"
                                    >
                                        {{ session("captcha_question") }} = ?
                                    </div>
                                    <!-- Captcha Refresh Icon -->
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
                                    class="input-field w-full px-4 py-2.5 rounded-lg"
                                    placeholder="Jawaban Anda"
                                />
                                @error('captcha')
                                <p class="text-sm text-red-600 mt-1">
                                    {{ $message }}
                                </p>
                                @enderror
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
                const button = event.target.closest('button');
                
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
                    const captchaSection = document.querySelector('.captcha-display').closest('div.mb-4');
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