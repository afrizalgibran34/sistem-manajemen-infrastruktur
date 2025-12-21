@extends('layouts.app', [
    'activePage' => 'gangguan_index',
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

                    <div class="form-group mb-3">
                        <label>Tanggal Kejadian</label>
                        <input type="date" name="tanggal"
                               value="{{ $data->tanggal }}"
                               class="form-control rounded-md border-gray-300" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Titik Lokasi</label>
                        <select name="id_titik" class="form-control rounded-md border-gray-300" required>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}"
                                    {{ $data->id_titik == $t->id_titik ? 'selected' : '' }}>
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Masalah</label>
                        <select name="id_jenismasalah" class="form-control rounded-md border-gray-300" required>
                            @foreach ($jenis_masalah as $j)
                                <option value="{{ $j->id_jenismasalah }}"
                                    {{ $data->id_jenismasalah == $j->id_jenismasalah ? 'selected' : '' }}>
                                    {{ $j->nama_masalah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control rounded-md border-gray-300">{{ $data->keterangan }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Penanganan</label>
                        <textarea name="penanganan"
                                  class="form-control rounded-md border-gray-300">{{ $data->penanganan }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jumlah Kunjungan</label>
                        <input type="number" name="jumlah_kunjungan"
                               value="{{ $data->jumlah_kunjungan }}"
                               class="form-control rounded-md border-gray-300">
                    </div>

                    <div class="form-group mb-3">
                        <label>Status Masalah</label>
                        <select name="status_masalah" class="form-control rounded-md border-gray-300" required>
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
