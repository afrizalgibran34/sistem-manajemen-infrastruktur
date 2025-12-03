<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Backbone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('backbone.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded mb-4 inline-block">
                       + Tambah Backbone
                    </a>

                    <table class="w-full mt-4 border border-gray-600">
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Jenis Backbone</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>

                        @forelse ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->id_backbone }}</td>
                            <td class="border p-2">{{ $row->jenis_backbone }}</td>

                            <td class="border p-2">
                                <a href="{{ route('backbone.edit', $row->id_backbone) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('backbone.destroy', $row->id_backbone) }}"
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
                            <td colspan="3" class="text-center p-2">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
