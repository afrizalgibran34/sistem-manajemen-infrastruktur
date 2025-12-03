<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Titik Lokasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('titik_lokasi.update', $data->id_titik) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">

                            <!-- NAMA TITIK -->
                            <div>
                                <label>Nama Titik</label>
                                <input type="text" name="nama_titik"
                                       value="{{ $data->nama_titik }}"
                                       class="w-full p-2 border rounded text-black"
                                       required>
                            </div>

                            <!-- WILAYAH -->
                            <div>
                                <label>Wilayah</label>
                                <select name="id_wilayah" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($wilayah as $item)
                                        <option value="{{ $item->id_wilayah }}"
                                            {{ $data->id_wilayah == $item->id_wilayah ? 'selected' : '' }}>
                                            {{ $item->nama_wilayah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- KEC KEL -->
                            <div>
                                <label>Kecamatan / Kelurahan</label>
                                <select name="id_kec_kel" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($kec_kel as $item)
                                        <option value="{{ $item->id_kec_kel }}"
                                            {{ $data->id_kec_kel == $item->id_kec_kel ? 'selected' : '' }}>
                                            {{ $item->nama_kec_kel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- KLASIFIKASI -->
                            <div>
                                <label>Klasifikasi</label>
                                <select name="id_klasifikasi" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($klasifikasi as $item)
                                        <option value="{{ $item->id_klasifikasi }}"
                                            {{ $data->id_klasifikasi == $item->id_klasifikasi ? 'selected' : '' }}>
                                            {{ $item->klasifikasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- KONEKSI -->
                            <div>
                                <label>Koneksi</label>
                                <select name="id_koneksi" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($koneksi as $item)
                                        <option value="{{ $item->id_koneksi }}"
                                            {{ $data->id_koneksi == $item->id_koneksi ? 'selected' : '' }}>
                                            {{ $item->jenis_koneksi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- STATUS -->
                            <div>
                                <label>Status</label>
                                <select name="id_status" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id_status }}"
                                            {{ $data->id_status == $item->id_status ? 'selected' : '' }}>
                                            {{ $item->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- BACKBONE -->
                            <div>
                                <label>Backbone</label>
                                <select name="id_backbone" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($backbone as $item)
                                        <option value="{{ $item->id_backbone }}"
                                            {{ $data->id_backbone == $item->id_backbone ? 'selected' : '' }}>
                                            {{ $item->jenis_backbone }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- UPLINK -->
                            <div>
                                <label>Uplink</label>
                                <select name="id_uplink" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($uplink as $item)
                                        <option value="{{ $item->id_uplink }}"
                                            {{ $data->id_uplink == $item->id_uplink ? 'selected' : '' }}>
                                            {{ $item->jenis_uplink }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- PERANGKAT -->
                            <div>
                                <label>Perangkat</label>
                                <select name="id_perangkat" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($perangkat as $item)
                                        <option value="{{ $item->id_perangkat }}"
                                            {{ $data->id_perangkat == $item->id_perangkat ? 'selected' : '' }}>
                                            {{ $item->jenis_perangkat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- LATITUDE -->
                            <div>
                                <label>Latitude</label>
                                <input type="text" name="latitude"
                                       value="{{ $data->latitude }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <!-- LONGITUDE -->
                            <div>
                                <label>Longitude</label>
                                <input type="text" name="longitude"
                                       value="{{ $data->longitude }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <!-- KETERANGAN -->
                            <div class="col-span-2">
                                <label>Keterangan</label>
                                <textarea name="keterangan"
                                          class="w-full p-2 border rounded text-black"
                                          rows="4">{{ $data->keterangan }}</textarea>
                            </div>

                            <!-- RENCANA PENGEMBANGAN -->
                            <div class="col-span-2">
                                <label>Rencana Pengembangan</label>
                                <textarea name="rencana_pengembangan"
                                          class="w-full p-2 border rounded text-black"
                                          rows="4">{{ $data->rencana_pengembangan }}</textarea>
                            </div>

                        </div>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded mt-4">Update</button>

                        <a href="{{ route('titik_lokasi.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded ml-2 mt-4 inline-block">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
