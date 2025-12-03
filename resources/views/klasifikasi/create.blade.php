<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Tambah Klasifikasi</h2>

    <form action="{{ route('klasifikasi.store') }}" method="POST">
        @csrf

        <label>Klasifikasi</label>
        <input type="text" name="klasifikasi" class="border p-2 w-full" required>

        <button class="mt-4 px-4 py-2 bg-green-600 text-black rounded">Simpan</button>
    </form>
</x-app-layout>
