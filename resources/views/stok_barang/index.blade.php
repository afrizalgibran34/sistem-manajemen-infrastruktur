<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Data Stok Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <a href="{{ route('stok_barang.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                    + Tambah Stok Barang
                </a>

                <table class="w-full border mt-3 text-sm">
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border p-2">Barang</th>
                        <th class="border p-2">Satuan</th>
                        <th class="border p-2">Kuantitas</th>
                        <th class="border p-2">Terpakai</th>
                        <th class="border p-2">Sisa</th>
                        <th class="border p-2">Aksi</th>
                    </tr>

                    @foreach ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->barang->nama_barang }}</td>
                            <td class="border p-2">{{ $row->satuan }}</td>
                            <td class="border p-2">{{ $row->kuantitas }}</td>
                            <td class="border p-2">{{ $row->terpakai }}</td>
                            <td class="border p-2">{{ $row->sisa }}</td>

                            <td class="border p-2">
                                <a href="{{ route('stok_barang.edit', $row->stok_id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                                <form action="{{ route('stok_barang.destroy', $row->stok_id) }}"
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded"
                                        onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
