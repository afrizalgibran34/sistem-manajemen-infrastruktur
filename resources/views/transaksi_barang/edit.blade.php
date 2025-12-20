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

                            {{-- Tanggal --}}
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control"
                                    value="{{ $data->tanggal instanceof \Carbon\Carbon ? $data->tanggal->format('Y-m-d') : $data->tanggal }}"
                                    required
                                >
                            </div>

                            {{-- Lokasi --}}
                            <div class="form-group">
                                <label>Titik Lokasi</label>
                                <select name="lokasi_id" class="form-control" required>
                                    @foreach ($titiks as $l)
                                        <option value="{{ $l->id_titik }}"
                                            {{ $data->lokasi_id == $l->id_titik ? 'selected' : '' }}>
                                            {{ $l->nama_titik }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Barang --}}
                            <div class="form-group">
                                <label>Barang</label>
                                <select name="stok_id" class="form-control" required>
                                    @foreach ($stokBarang as $stok)
                                        <option value="{{ $stok->stok_id }}"
                                            {{ $data->stok_id == $stok->stok_id ? 'selected' : '' }}>
                                            {{ $stok->barang->nama_barang }}
                                            (Sisa: {{ $stok->sisa }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jumlah --}}
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input
                                    type="number"
                                    name="jumlah"
                                    class="form-control"
                                    value="{{ $data->jumlah }}"
                                    min="1"
                                    required
                                >
                            </div>

                            {{-- Keterangan --}}
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3">{{ $data->keterangan }}</textarea>
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
