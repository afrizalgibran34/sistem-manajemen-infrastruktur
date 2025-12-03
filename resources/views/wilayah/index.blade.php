<x-app-layout>
     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wilayah') }}
        </h2>
    </x-slot>

    <a href="{{ route('wilayah.create') }}" class="px-4 py-2 bg-blue-600 text-black rounded">Tambah</a>

    <table class="w-full mt-4 border">
        <tr class="bg-gray-200">
            <th class="p-2 border">ID</th>
            <th class="p-2 border">Nama Wilayah</th>
            <th class="p-2 border">Aksi</th>
        </tr>

        @foreach ($data as $row)
        <tr>
            <td class="border p-2">{{ $row->id_wilayah }}</td>
            <td class="border p-2">{{ $row->nama_wilayah }}</td>
            <td class="border p-2">
                <a href="{{ route('wilayah.edit', $row->id_wilayah) }}" class="text-blue-600">Edit</a>

                <form action="{{ route('wilayah.destroy', $row->id_wilayah) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin?')" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
