<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Data Transaksi Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <a href="{{ route('transaksi_barang.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                    + Tambah Transaksi
                </a>

                <table class="w-full border mt-3 text-sm">
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Lokasi</th>
                        <th class="border p-2">Barang</th>
                        <th class="border p-2">Jumlah</th>
                        <th class="border p-2">Keterangan</th>
                        <th class="border p-2">Aksi</th>
                    </tr>

                    @foreach ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->tanggal }}</td>
                            <td class="border p-2">{{ $row->lokasi->nama_lokasi }}</td>
                            <td class="border p-2">{{ $row->barang->nama_barang }}</td>
                            <td class="border p-2">{{ $row->jumlah }}</td>
                            <td class="border p-2">{{ $row->keterangan }}</td>

                            <td class="border p-2">
                                <a href="{{ route('transaksi_barang.edit', $row->transaksi_id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                                <form action="{{ route('transaksi_barang.destroy', $row->transaksi_id) }}"
                                        method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded"
                                            onclick="return confirm('Hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
