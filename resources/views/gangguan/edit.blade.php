@extends('layouts.app', [
    'activePage' => 'gangguan',
    'title' => __('Edit Gangguan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Gangguan</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('gangguan.update', $data->id_gangguan) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Tanggal Kejadian</label>
                        <input type="date" name="tanggal"
                               value="{{ $data->tanggal }}"
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Titik Lokasi</label>
                        <select name="id_titik" class="form-control" required>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}"
                                    {{ $data->id_titik == $t->id_titik ? 'selected' : '' }}>
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis Masalah</label>
                        <select name="id_jenismasalah" class="form-control" required>
                            @foreach ($jenis_masalah as $j)
                                <option value="{{ $j->id_jenismasalah }}"
                                    {{ $data->id_jenismasalah == $j->id_jenismasalah ? 'selected' : '' }}>
                                    {{ $j->nama_masalah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control">{{ $data->keterangan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Penanganan</label>
                        <textarea name="penanganan"
                                  class="form-control">{{ $data->penanganan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Kunjungan</label>
                        <input type="number" name="jumlah_kunjungan"
                               value="{{ $data->jumlah_kunjungan }}"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Status Masalah</label>
                        <select name="status_masalah" class="form-control" required>
                            <option value="Selesai" 
                                {{ $data->status_masalah == 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                            <option value="Tidak Selesai"
                                {{ $data->status_masalah == 'Tidak Selesai' ? 'selected' : '' }}>
                                Tidak Selesai
                            </option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('gangguan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
