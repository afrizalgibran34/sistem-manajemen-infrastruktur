<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Jenis Masalah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('jenis_masalah.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                        + Tambah Jenis Masalah
                    </a>

                    <table class="w-full border border-gray-600 mt-4">
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama Masalah</th>
                            <th class="border p-2">Aksi</th>
                        </tr>

                        @forelse ($data as $row)
                            <tr>
                                <td class="border p-2">{{ $row->id_jenismasalah }}</td>
                                <td class="border p-2">{{ $row->nama_masalah }}</td>

                                <td class="border p-2">
                                    <a href="{{ route('jenis_masalah.edit', $row->id_jenismasalah) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('jenis_masalah.destroy', $row->id_jenismasalah) }}"
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
                                <td colspan="3" class="p-2 text-center">Tidak ada data</td>
                            </tr>
                        @endforelse

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
