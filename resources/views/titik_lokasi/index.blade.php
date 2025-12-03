<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Titik Lokasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('titik_lokasi.create') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded inline-block mb-4">
                       + Tambah Titik Lokasi
                    </a>

                    <table class="w-full border border-gray-600 text-sm">
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="border p-2">Nama Titik</th>
                            <th class="border p-2">Wilayah</th>
                            <th class="border p-2">Kec/Kel</th>
                            <th class="border p-2">Klasifikasi</th>
                            <th class="border p-2">Koneksi</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Backbone</th>
                            <th class="border p-2">Uplink</th>
                            <th class="border p-2">Perangkat</th>
                            <th class="border p-2">Aksi</th>
                        </tr>

                        @foreach ($data as $row)
                        <tr>
                            <td class="border p-2">{{ $row->nama_titik }}</td>
                            <td class="border p-2">{{ $row->wilayah->nama_wilayah }}</td>
                            <td class="border p-2">{{ $row->kec_kel->nama_kec_kel }}</td>
                            <td class="border p-2">{{ $row->klasifikasi->klasifikasi }}</td>
                            <td class="border p-2">{{ $row->koneksi->jenis_koneksi }}</td>
                            <td class="border p-2">{{ $row->status->status }}</td>
                            <td class="border p-2">{{ $row->backbone->jenis_backbone }}</td>
                            <td class="border p-2">{{ $row->uplink->jenis_uplink }}</td>
                            <td class="border p-2">{{ $row->perangkat->jenis_perangkat }}</td>

                            <td class="border p-2">
                                <a href="{{ route('titik_lokasi.edit', $row->id_titik) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('titik_lokasi.destroy', $row->id_titik) }}"
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus data?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">
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
    </div>
</x-app-layout>
