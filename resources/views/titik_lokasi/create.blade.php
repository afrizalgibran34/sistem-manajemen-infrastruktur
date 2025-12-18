@extends('layouts.app', [
    'activePage' => 'titik_lokasi_create',
    'title' => __('Tambah Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Titik/Lokasi Layanan</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('titik_lokasi.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Titik/Lokasi Layanan</label>
                        <input type="text" name="nama_titik" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Wilayah</label>
                        <select name="id_wilayah" class="form-control" required>
                            <option value="">-- Pilih Wilayah --</option>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id_wilayah }}">{{ $w->nama_wilayah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>PD / UNIT KERJA / INSTANSI</label>
                        <select name="id_kec_kel" class="form-control" required>
                            <option value="">-- Pilih PD / UNIT KERJA / INSTANSI --</option>
                            @foreach ($kec_kel as $k)
                                <option value="{{ $k->id_kec_kel }}">{{ $k->nama_kec_kel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Klasifikasi</label>
                        <select name="id_klasifikasi" class="form-control" required>
                            <option value="">-- Pilih Klasifikasi --</option>
                            @foreach ($klasifikasi as $k)
                                <option value="{{ $k->id_klasifikasi }}">{{ $k->klasifikasi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Koneksi</label>
                        <select name="koneksi" id="koneksi" class="form-control" required>
                            <option value="">-- Pilih Koneksi --</option>
                            <option value="FO">FO</option>
                            <option value="Wireless">Wireless</option>
                        </select>
                    </div>

                    {{-- PANJANG FO --}}
                    <div class="form-group" id="panjang_fo_group" style="display:none;">
                        <label>Panjang FO (meter)</label>
                        <input type="number" name="panjang_fo" class="form-control" min="0" placeholder="Contoh: 1500">
                    </div>

                    {{-- TAHUN PEMBANGUNAN --}}
                    <div class="form-group">
                        <label>Tahun Pembangunan</label>
                        <input type="number"
                               name="tahun_pembangunan"
                               class="form-control"
                               min="1900"
                               max="{{ date('Y') }}"
                               placeholder="Contoh: 2021"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="On">On</option>
                            <option value="Off">Off</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Backbone</label>
                        <select name="id_backbone" class="form-control" required>
                            <option value="">-- Pilih Backbone --</option>
                            @foreach ($backbone as $b)
                                <option value="{{ $b->id_backbone }}">{{ $b->jenis_backbone }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Uplink</label>
                        <select name="id_uplink" class="form-control" required>
                            <option value="">-- Pilih Uplink --</option>
                            @foreach ($uplink as $u)
                                <option value="{{ $u->id_uplink }}">{{ $u->jenis_uplink }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Perangkat Yang Terpasang</label>
                        <input type="text" name="perangkat" class="form-control" placeholder="Masukkan nama perangkat" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('titik_lokasi.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const koneksi = document.getElementById('koneksi');
        const foGroup = document.getElementById('panjang_fo_group');

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
@endsection
