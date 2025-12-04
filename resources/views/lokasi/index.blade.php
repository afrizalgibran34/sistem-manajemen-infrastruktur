<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Data Lokasi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">

                <a href="{{ route('lokasi.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                    + Tambah Lokasi
                </a>

                <table class="w-full border mt-3">
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Nama Lokasi</th>
                        <th class="border p-2">Aksi</th>
                    </tr>

                    @foreach ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->lokasi_id }}</td>
                            <td class="border p-2">{{ $row->nama_lokasi }}</td>

                            <td class="border p-2">
                                <a href="{{ route('lokasi.edit', $row->lokasi_id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                                <form action="{{ route('lokasi.destroy', $row->lokasi_id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </div>
</x-app-layout>
