@extends('layouts.app', [
    'activePage' => 'gangguan',
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

                    <div class="form-group">
                        <label>Tanggal Kejadian</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Titik Lokasi</label>
                        <select name="id_titik" class="form-control" required>
                            <option value="">-- Pilih Titik Lokasi --</option>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}">
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Masalah</label>
                        <select name="id_jenismasalah" class="form-control" required>
                            <option value="">-- Pilih Masalah --</option>
                            @foreach ($jenis_masalah as $j)
                                <option value="{{ $j->id_jenismasalah }}">
                                    {{ $j->nama_masalah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Penanganan</label>
                        <textarea name="penanganan" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Kunjungan</label>
                        <input type="number" name="jumlah_kunjungan" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Status Masalah</label>
                        <select name="status_masalah" class="form-control" required>
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
