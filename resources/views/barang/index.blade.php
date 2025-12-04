<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Data Barang</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <a href="{{ route('barang.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                    + Tambah Barang
                </a>

                <table class="w-full border mt-3">
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Nama Barang</th>
                        <th class="border p-2">Satuan</th>
                        <th class="border p-2">Aksi</th>
                    </tr>

                    @foreach ($data as $item)
                        <tr>
                            <td class="border p-2">{{ $item->barang_id }}</td>
                            <td class="border p-2">{{ $item->nama_barang }}</td>
                            <td class="border p-2">{{ $item->satuan }}</td>
                            <td class="border p-2">
                                <a href="{{ route('barang.edit', $item->barang_id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                                <form action="{{ route('barang.destroy', $item->barang_id) }}"
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
