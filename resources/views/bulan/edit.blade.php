<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Bulan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('bulan.update', $data->id_bulan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="block mb-2">Nama Bulan</label>
                        <input type="text" name="nama_bulan"
                               class="w-full p-2 border rounded text-black mb-4"
                               value="{{ $data->nama_bulan }}" required>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>

                        <a href="{{ route('bulan.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded ml-2">
                           Kembali
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
