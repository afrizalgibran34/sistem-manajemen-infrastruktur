<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Koneksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Tombol Tambah -->
                    <a href="{{ route('koneksi.create') }}"
                       class="px-4 py-2 bg-blue-600 text-black rounded mb-4 inline-block">
                       + Tambah Koneksi
                    </a>

                    <!-- Tabel Data -->
                    <table class="w-full mt-4 border border-gray-600">
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Jenis Koneksi</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>

                        @forelse ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->id_koneksi }}</td>
                            <td class="border p-2">{{ $row->jenis_koneksi }}</td>

                            <td class="border p-2">
                                <a href="{{ route('koneksi.edit', $row->id_koneksi) }}"
                                  class="text-blue-600">
                                    Edit
                                </a>

                                <form action="{{ route('koneksi.destroy', $row->id_koneksi) }}"
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus data ini?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center text-gray-400 dark:text-gray-200">
                                Tidak ada data
                            </td>
                        </tr>
                        @endforelse
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
