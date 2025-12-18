@extends('layouts.app', [
    'activePage' => 'barang_keluar',
    'title' => __('Edit Transaksi Barang'),
    'navName' => 'Transaksi Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Edit Transaksi Barang</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('transaksi_barang.update', $data->transaksi_id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"
                                       value="{{ $data->tanggal }}" required>
                            </div>

                            <div class="form-group">
                                <label>Lokasi</label>
                                <select name="lokasi_id" class="form-control" required>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id_titik }}"
                                            {{ $data->lokasi_id == $l->id_titik ? 'selected' : '' }}>
                                            {{ $l->nama_lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Barang</label>
                                <select name="barang_id" class="form-control" required>
                                    @foreach ($barang as $b)
                                    <option value="{{ $b->barang_id }}"
                                        {{ $data->barang_id == $b->barang_id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control"
                                       value="{{ $data->jumlah }}" required>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan"
                                          class="form-control">{{ $data->keterangan }}</textarea>
                            </div>

                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('transaksi_barang.index') }}" class="btn btn-secondary">Kembali</a>

                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
