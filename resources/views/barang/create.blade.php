<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf

                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang"
                           class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Satuan</label>
                    <input type="text" name="satuan"
                           class="w-full p-2 border rounded text-black mb-4" required>

                    <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                    <a href="{{ route('barang.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded ml-2">Kembali</a>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
