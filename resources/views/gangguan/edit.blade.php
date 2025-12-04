<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Gangguan Jaringan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('gangguan.update', $data->id_gangguan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label>Tanggal</label>
                                <input type="date" name="tanggal"
                                       value="{{ $data->tanggal }}"
                                       class="w-full p-2 border rounded text-black" required>
                            </div>

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

                            <div>
                                <label>Perangkat Daerah</label>
                                <select name="id_perangkat" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($perangkat as $item)
                                        <option value="{{ $item->id_perangkat }}"
                                            {{ $data->id_perangkat == $item->id_perangkat ? 'selected' : '' }}>
                                            {{ $item->nama_perangkat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>FO / Wireless</label>
                                <input type="text" name="fo_wireless"
                                       value="{{ $data->fo_wireless }}"
                                       class="w-full p-2 border rounded text-black" required>
                            </div>

                            <div>
                                <label>Jenis Masalah</label>
                                <select name="id_jenismasalah" class="w-full p-2 border rounded text-black" required>
                                    @foreach ($jenis_masalah as $item)
                                        <option value="{{ $item->id_jenismasalah }}"
                                            {{ $data->id_jenismasalah == $item->id_jenismasalah ? 'selected' : '' }}>
                                            {{ $item->nama_masalah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Jumlah Kunjungan</label>
                                <input type="number" name="jumlah_kunjungan"
                                       value="{{ $data->jumlah_kunjungan }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <div>
                                <label>Komplain Masuk</label>
                                <input type="number" name="komplain_masuk"
                                       value="{{ $data->komplain_masuk }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <div>
                                <label>Masalah Selesai</label>
                                <input type="number" name="masalah_selesai"
                                       value="{{ $data->masalah_selesai }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <div>
                                <label>Masalah Tidak Selesai</label>
                                <input type="number" name="masalah_tidak_selesai"
                                       value="{{ $data->masalah_tidak_selesai }}"
                                       class="w-full p-2 border rounded text-black">
                            </div>

                            <div class="col-span-2">
                                <label>Keterangan</label>
                                <textarea name="keterangan"
                                    class="w-full p-2 border rounded text-black">{{ $data->keterangan }}</textarea>
                            </div>

                            <div class="col-span-2">
                                <label>Penanganan</label>
                                <textarea name="penanganan"
                                    class="w-full p-2 border rounded text-black">{{ $data->penanganan }}</textarea>
                            </div>

                        </div>

                        <button class="px-4 py-2 bg-blue-600 text-white rounded mt-4">
                            Update
                        </button>

                        <a href="{{ route('gangguan.index') }}"
                           class="px-4 py-2 bg-gray-600 text-white rounded ml-2 mt-4 inline-block">
                           Kembali
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
