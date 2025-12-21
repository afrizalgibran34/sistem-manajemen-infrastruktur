<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Ubah Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Pastikan password baru Anda kuat dan mudah diingat oleh Anda sendiri.
        </p>
    </header>

    {{-- ================= TRIGGER SWEETALERT (FIXED) ================= --}}
    @if (session('swal_success'))
        <div
            id="swal-success"
            data-message="{{ session('swal_success') }}">
        </div>
    @elseif ($errors->updatePassword->has('current_password'))
        <div
            id="swal-error"
            data-message="Password lama yang Anda masukkan salah.">
        </div>
    @endif
    {{-- =============================================================== --}}

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- PASSWORD LAMA --}}
        <div class="relative">
            <x-input-label for="update_password_current_password" value="Password Lama" />

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="off"
                class="mt-1 block w-full pr-12 rounded-md border-gray-300
                       focus:border-indigo-500 focus:ring-indigo-500"
                required
            />

            <button
                type="button"
                onclick="togglePassword('update_password_current_password', 'eye-current', 'eye-slash-current')"
                class="absolute right-3 top-[42px] z-10 text-gray-500"
            >
                <svg id="eye-current" class="w-5 h-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>
                </svg>

                <svg id="eye-slash-current" class="w-5 h-5 hidden" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18"/>
                </svg>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- PASSWORD BARU --}}
        <div class="relative">
            <x-input-label for="update_password_password" value="Password Baru" />

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full pr-12 rounded-md border-gray-300
                       focus:border-indigo-500 focus:ring-indigo-500"
                required
            />

            <button
                type="button"
                onclick="togglePassword('update_password_password', 'eye-new', 'eye-slash-new')"
                class="absolute right-3 top-[42px] z-10 text-gray-500"
            >
                <svg id="eye-new" class="w-5 h-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>
                </svg>

                <svg id="eye-slash-new" class="w-5 h-5 hidden" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18"/>
                </svg>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div class="relative">
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Password Baru" />

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full pr-12 rounded-md border-gray-300
                       focus:border-indigo-500 focus:ring-indigo-500"
                required
            />

            <button
                type="button"
                onclick="togglePassword('update_password_password_confirmation', 'eye-confirm', 'eye-slash-confirm')"
                class="absolute right-3 top-[42px] z-10 text-gray-500"
            >
                <svg id="eye-confirm" class="w-5 h-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>
                </svg>

                <svg id="eye-slash-confirm" class="w-5 h-5 hidden" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18"/>
                </svg>
            </button>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Simpan Password
            </x-primary-button>
        </div>
    </form>
</section>

{{-- JS SHOW / HIDE PASSWORD --}}
<script>
function togglePassword(inputId, eyeId, eyeSlashId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    const eyeSlash = document.getElementById(eyeSlashId);

    if (input.type === 'password') {
        input.type = 'text';
        eye.classList.add('hidden');
        eyeSlash.classList.remove('hidden');
    } else {
        input.type = 'password';
        eye.classList.remove('hidden');
        eyeSlash.classList.add('hidden');
    }
}
</script>
