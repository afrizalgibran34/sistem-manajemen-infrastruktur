<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Koneksi') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">

            <form action="{{ route('koneksi.update', $data->id_koneksi) }}" method="POST">
                @csrf
                @method('PUT')

                <label class="block mb-2">Jenis Koneksi</label>
                <input type="text" name="jenis_koneksi" class="border p-2 w-full rounded mb-4"
                       value="{{ $data->jenis_koneksi }}" required>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </form>

        </div>
    </div>
</x-app-layout>
