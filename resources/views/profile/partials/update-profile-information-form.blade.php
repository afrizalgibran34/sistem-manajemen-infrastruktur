<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi profil akun Anda.
        </p>
    </header>

    {{-- ================= SWEETALERT TRIGGER ================= --}}
    @if (session('swal_success'))
        <div id="swal-success" data-message="{{ session('swal_success') }}"></div>
    @endif

    @if ($errors->has('current_password'))
        <div id="swal-error" data-message="Password yang Anda masukkan tidak valid."></div>
    @endif
    {{-- ====================================================== --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nama --}}
        <div>
            <x-input-label for="name" value="Nama" class="text-black" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full pr-12 rounded-md border-gray-300 bg-gray-100"
                style="background-color: #f3f4f6 !important; color: #111827 !important;"
                :value="old('name', $user->name)"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Verifikasi Password (SHOW / HIDE) --}}
        <div class="relative">
            <x-input-label for="current_password" value="Verifikasi Password" class="text-black" />

            <input
                id="current_password"
                name="current_password"
                type="password"
                autocomplete="off"
                class="mt-1 block w-full pr-12 rounded-md border-gray-300 bg-gray-100"
                style="background-color: #f3f4f6 !important; color: #111827 !important;"
                placeholder="Masukkan password saat ini"
                required
            />

            {{-- Toggle --}}
            <button
                type="button"
                onclick="togglePassword('current_password', 'eye-profile', 'eye-slash-profile')"
                class="absolute right-3 top-1/2 transform translate-y-1/4 z-10 text-gray-500"
            >
                <svg id="eye-profile" class="w-5 h-5" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>
                </svg>

                <svg id="eye-slash-profile" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3l18 18"/>
                </svg>
            </button>

            <x-input-error class="mt-2" :messages="$errors->get('current_password')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color: #0d6efd !important;">
                Simpan Perubahan
            </x-primary-button>
        </div>
    </form>
</section>

{{-- JS Toggle Password --}}
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

<style>
/* Override focus style untuk input nama dan password */
#name:focus,
#current_password:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    outline: none !important;
}
</style>