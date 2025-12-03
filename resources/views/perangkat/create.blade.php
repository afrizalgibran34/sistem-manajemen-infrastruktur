<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Perangkat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('perangkat.store') }}" method="POST">
                        @csrf

                        <label class="block mb-2">Jenis Perangkat</label>
                        <input type="text" name="jenis_perangkat"
                               class="w-full p-2 border rounded text-black mb-4"
                               required>

                        <button class="px-4 py-2 bg-green-600 text-white rounded">
                            Simpan
                        </button>

                        <a href="{{ route('perangkat.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded ml-2">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
