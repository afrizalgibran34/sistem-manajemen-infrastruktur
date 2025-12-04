<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Stok Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('stok_barang.update', $data->stok_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label>Barang</label>
                    <select name="barang_id" class="w-full p-2 border rounded text-black mb-4" required>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}"
                                {{ $data->barang_id == $item->barang_id ? 'selected' : '' }}>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>

                    <label>Satuan</label>
                    <input type="text" name="satuan"
                           value="{{ $data->satuan }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <label>Kuantitas</label>
                    <input type="text" name="kuantitas"
                           value="{{ $data->kuantitas }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <label>Terpakai</label>
                    <input type="text" name="terpakai"
                           value="{{ $data->terpakai }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <label>Sisa</label>
                    <input type="text" name="sisa"
                           value="{{ $data->sisa }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <label>Keterangan</label>
                    <input type="text" name="keterangan"
                           value="{{ $data->keterangan }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>

                    <a href="{{ route('stok_barang.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded ml-2">Kembali</a>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
