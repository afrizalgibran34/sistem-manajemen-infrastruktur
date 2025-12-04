<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Stok Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('stok_barang.store') }}" method="POST">
                    @csrf

                    <label>Barang</label>
                    <select name="barang_id" class="w-full p-2 border rounded text-black mb-4" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>

                    <label>Satuan</label>
                    <input type="text" name="satuan" class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Kuantitas</label>
                    <input type="text" name="kuantitas" class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Terpakai</label>
                    <input type="text" name="terpakai" class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Sisa</label>
                    <input type="text" name="sisa" class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="w-full p-2 border rounded text-black mb-4">

                    <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>

                    <a href="{{ route('stok_barang.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded ml-2">Kembali</a>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
