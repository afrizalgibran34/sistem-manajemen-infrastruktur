<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Edit Klasifikasi</h2>

    <form action="{{ route('klasifikasi.update', $data->id_klasifikasi) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Klasifikasi</label>
        <input type="text" name="klasifikasi" value="{{ $data->klasifikasi }}" class="border p-2 w-full" required>

        <button class="mt-4 px-4 py-2 bg-blue-600 text-black rounded">Update</button>
    </form>
</x-app-layout>
