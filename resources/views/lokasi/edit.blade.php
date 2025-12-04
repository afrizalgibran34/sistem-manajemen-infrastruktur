<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Lokasi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('lokasi.update', $data->lokasi_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label>Nama Lokasi</label>
                    <input type="text" name="nama_lokasi"
                           value="{{ $data->nama_lokasi }}"
                           class="w-full p-2 border rounded text-black mb-4" required>

                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>

                    <a href="{{ route('lokasi.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded ml-2">Kembali</a>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
