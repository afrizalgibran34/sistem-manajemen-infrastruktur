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
                        <label>Wilayah</label>
                        <select name="id_wilayah" class="form-control" required>
                            <option value="">-- Pilih Wilayah --</option>
                            @foreach ($wilayah as $w)
                                <option value="{{ $w->id_wilayah }}">{{ $w->nama_wilayah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Perangkat Daerah</label>
                        <select name="id_perangkat" class="form-control" required>
                            <option value="">-- Pilih Perangkat --</option>
                            @foreach ($perangkat as $p)
                                <option value="{{ $p->id_perangkat }}">{{ $p->nama_perangkat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Jaringan (FO / Wireless)</label>
                        <input type="text" name="FO_wireless" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Masalah</label>
                        <select name="id_jenismasalah" class="form-control" required>
                            <option value="">-- Pilih Masalah --</option>
                            @foreach ($jenis_masalah as $j)
                                <option value="{{ $j->id_jenismasalah }}">{{ $j->nama_masalah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan Masalah</label>
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
                        <label>Komplain Masuk</label>
                        <input type="number" name="komplain_masuk" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Masalah Selesai</label>
                        <input type="number" name="masalahselesai" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Masalah Tidak Selesai</label>
                        <input type="number" name="masalahtidakselesai" class="form-control">
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('gangguan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
