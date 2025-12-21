@extends('layouts.app', [
    'activePage' => 'gangguan_create',
    'title' => __('Tambah Gangguan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Gangguan</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('gangguan.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Tanggal Kejadian <span style="color: red;">*</span></label>
                        <input type="date" 
                               name="tanggal" 
                               class="form-control rounded-md border-gray-300" 
                               onclick="this.showPicker()"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Titik Lokasi <span style="color: red;">*</span></label>
                        <select name="id_titik" class="form-control rounded-md border-gray-300" required>
                            <option value="">-- Pilih Titik Lokasi --</option>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}">
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Masalah <span style="color: red;">*</span></label>
                        <select name="id_jenismasalah" class="form-control rounded-md border-gray-300" required>
                            <option value="">-- Pilih Masalah --</option>
                            @foreach ($jenis_masalah as $j)
                                <option value="{{ $j->id_jenismasalah }}">
                                    {{ $j->nama_masalah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control rounded-md border-gray-300"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Penanganan</label>
                        <textarea name="penanganan" class="form-control rounded-md border-gray-300"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jumlah Kunjungan</label>
                        <input type="number" name="jumlah_kunjungan" class="form-control rounded-md border-gray-300">
                    </div>

                    <div class="form-group mb-3">
                        <label>Status Masalah</label>
                        <select name="status_masalah" class="form-control rounded-md border-gray-300" required>
                            <option value="Selesai">Selesai</option>
                            <option value="Tidak Selesai">Tidak Selesai</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('gangguan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection