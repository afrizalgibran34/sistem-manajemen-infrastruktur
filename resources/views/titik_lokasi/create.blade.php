<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Titik Lokasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('titik_lokasi.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label>Nama Titik</label>
                                <input name="nama_titik" class="w-full p-2 border rounded text-black" required>
                            </div>

                            <div>
                                <label>Wilayah</label>
                                <select name="id_wilayah" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($wilayah as $item)
                                        <option value="{{ $item->id_wilayah }}">{{ $item->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Kecamatan / Kelurahan</label>
                                <select name="id_kec_kel" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($kec_kel as $item)
                                        <option value="{{ $item->id_kec_kel }}">{{ $item->nama_kec_kel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Klasifikasi</label>
                                <select name="id_klasifikasi" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($klasifikasi as $item)
                                        <option value="{{ $item->id_klasifikasi }}">{{ $item->klasifikasi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Koneksi</label>
                                <select name="id_koneksi" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($koneksi as $item)
                                        <option value="{{ $item->id_koneksi }}">{{ $item->jenis_koneksi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Status</label>
                                <select name="id_status" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id_status }}">{{ $item->status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Backbone</label>
                                <select name="id_backbone" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($backbone as $item)
                                        <option value="{{ $item->id_backbone }}">{{ $item->jenis_backbone }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Uplink</label>
                                <select name="id_uplink" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($uplink as $item)
                                        <option value="{{ $item->id_uplink }}">{{ $item->jenis_uplink }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Perangkat</label>
                                <select name="id_perangkat" class="w-full p-2 border rounded text-black" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($perangkat as $item)
                                        <option value="{{ $item->id_perangkat }}">{{ $item->jenis_perangkat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Latitude</label>
                                <input name="latitude" class="w-full p-2 border rounded text-black">
                            </div>

                            <div>
                                <label>Longitude</label>
                                <input name="longitude" class="w-full p-2 border rounded text-black">
                            </div>

                            <div class="col-span-2">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="w-full p-2 border rounded text-black"></textarea>
                            </div>

                            <div class="col-span-2">
                                <label>Rencana Pengembangan</label>
                                <textarea name="rencana_pengembangan"
                                    class="w-full p-2 border rounded text-black"></textarea>
                            </div>

                        </div>

                        <button class="px-4 py-2 bg-green-600 text-black rounded mt-4">Simpan</button>

                        <a href="{{ route('titik_lokasi.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded ml-2">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
