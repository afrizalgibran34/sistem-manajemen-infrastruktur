<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Bulan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('bulan.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded inline-block mb-4">
                        + Tambah Bulan
                    </a>

                    <table class="w-full border border-gray-600 mt-4">
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama Bulan</th>
                            <th class="border p-2">Aksi</th>
                        </tr>

                        @forelse($data as $row)
                            <tr>
                                <td class="border p-2">{{ $row->id_bulan }}</td>
                                <td class="border p-2">{{ $row->nama_bulan }}</td>

                                <td class="border p-2">
                                    <a href="{{ route('bulan.edit', $row->id_bulan) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('bulan.destroy', $row->id_bulan) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus data ini?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center p-2">Tidak ada data</td>
                            </tr>
                        @endforelse

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
