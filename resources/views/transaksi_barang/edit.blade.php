<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Transaksi Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <form action="{{ route('transaksi_barang.update', $data->transaksi_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label>Tanggal</label>
                    <input type="text" name="tanggal" value="{{ $data->tanggal }}"
                           class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Lokasi</label>
                    <select name="lokasi_id" class="w-full p-2 border rounded text-black mb-4" required>
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->lokasi_id }}"
                                {{ $data->lokasi_id == $item->lokasi_id ? 'selected' : '' }}>
                                {{ $item->nama_lokasi }}
                            </option>
                        @endforeach
                    </select>

                    <label>Barang</label>
                    <select name="barang_id" class="w-full p-2 border rounded text-black mb-4" required>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}"
                                {{ $data->barang_id == $item->barang_id ? 'selected' : '' }}>
                                {{ $item->nama_barang }}
                            </option>
                        @endforeach
                    </select>

                    <label>Jumlah</label>
                    <input type="text" name="jumlah" value="{{ $data->jumlah }}"
                           class="w-full p-2 border rounded text-black mb-4" required>

                    <label>Keterangan</label>
                    <input type="text" name="keterangan" value="{{ $data->keterangan }}"
                           class="w-full p-2 border rounded text-black mb-4">

                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>

                    <a href="{{ route('transaksi_barang.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white rounded ml-2">
                        Kembali
                    </a>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
