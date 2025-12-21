@extends('layouts.app', [
    'activePage' => 'titik_lokasi_index',
    'title' => __('Edit Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Titik/Lokasi Layanan</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('titik_lokasi.update', $data->id_titik) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Titik/Lokasi Layanan</label>
                        <input type="text" name="nama_titik" value="{{ $data->nama_titik }}" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Wilayah</label>
                        <select name="id_wilayah" class="form-control rounded-md border-gray-300" required>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id_wilayah }}"
                                    {{ $data->id_wilayah == $w->id_wilayah ? 'selected' : '' }}>
                                    {{ $w->nama_wilayah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>PD / UNIT KERJA / INSTANSI</label>
                        <select name="id_kec_kel" class="form-control rounded-md border-gray-300" required>
                            @foreach ($kec_kel as $k)
                                <option value="{{ $k->id_kec_kel }}"
                                    {{ $data->id_kec_kel == $k->id_kec_kel ? 'selected' : '' }}>
                                    {{ $k->nama_kec_kel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Klasifikasi</label>
                        <select name="id_klasifikasi" class="form-control rounded-md border-gray-300" required>
                            @foreach ($klasifikasi as $k)
                                <option value="{{ $k->id_klasifikasi }}"
                                    {{ $data->id_klasifikasi == $k->id_klasifikasi ? 'selected' : '' }}>
                                    {{ $k->klasifikasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Koneksi</label>
                        <select name="koneksi" id="koneksi" class="form-control rounded-md border-gray-300" required>
                            <option value="FO" {{ $data->koneksi == 'FO' ? 'selected' : '' }}>FO</option>
                            <option value="Wireless" {{ $data->koneksi == 'Wireless' ? 'selected' : '' }}>Wireless</option>
                        </select>
                    </div>

                    {{-- PANJANG FO --}}
                    <div class="form-group mb-3" id="panjang_fo_group"
                        @if($data->koneksi != 'FO') style="display:none;" @endif>
                        <label>Panjang FO (meter)</label>
                        <input type="number"
                               name="panjang_fo"
                               class="form-control rounded-md border-gray-300"
                               min="0"
                               value="{{ $data->panjang_fo }}">
                    </div>

                    {{-- TAHUN PEMBANGUNAN --}}
                    <div class="form-group mb-3">
                        <label>Tahun Pembangunan</label>
                        <input type="number"
                               name="tahun_pembangunan"
                               class="form-control rounded-md border-gray-300"
                               min="1900"
                               max="{{ date('Y') }}"
                               value="{{ $data->tahun_pembangunan }}"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control rounded-md border-gray-300" required>
                            <option value="On" {{ $data->status == 'On' ? 'selected' : '' }}>On</option>
                            <option value="Off" {{ $data->status == 'Off' ? 'selected' : '' }}>Off</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Backbone</label>
                        <select name="id_backbone" class="form-control rounded-md border-gray-300" required>
                            @foreach ($backbone as $b)
                                <option value="{{ $b->id_backbone }}"
                                    {{ $data->id_backbone == $b->id_backbone ? 'selected' : '' }}>
                                    {{ $b->jenis_backbone }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Uplink</label>
                        <select name="id_uplink" class="form-control rounded-md border-gray-300" required>
                            @foreach ($uplink as $u)
                                <option value="{{ $u->id_uplink }}"
                                    {{ $data->id_uplink == $u->id_uplink ? 'selected' : '' }}>
                                    {{ $u->jenis_uplink }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Perangkat</label>
                        <input type="text" name="perangkat" value="{{ $data->perangkat }}" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control rounded-md border-gray-300">{{ $data->keterangan }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Latitude</label>
                        <input type="text" name="latitude" value="{{ $data->latitude }}" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Longitude</label>
                        <input type="text" name="longitude" value="{{ $data->longitude }}" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('titik_lokasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const koneksi = document.getElementById('koneksi');
        const foGroup = document.getElementById('panjang_fo_group');

        if (!koneksi || !foGroup) return;

        koneksi.addEventListener('change', function () {
            if (this.value === 'FO') {
                foGroup.style.display = 'block';
            } else {
                foGroup.style.display = 'none';
                foGroup.querySelector('input').value = '';
            }
        });
    });
</script>
@endpush

@endsection
