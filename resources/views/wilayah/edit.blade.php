<x-app-layout>
    <x-slot name="header">
    <h2 class="text-xl font-bold mb-4">Edit Wilayah</h2>

    <form action="{{ route('wilayah.update', $data->id_wilayah) }}" method="POST">
        @csrf @method('PUT')

        <label>Nama Wilayah</label>
        <input type="text" name="nama_wilayah" value="{{ $data->nama_wilayah }}" class="border p-2 w-full" required>

        <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Update</button>
    </form>
</x-app-layout>
