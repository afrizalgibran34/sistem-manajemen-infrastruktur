@extends('layouts.app', [
    'activePage' => 'stok_barang',
    'title' => __('Edit Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Stok Barang</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('stok_barang.update', $data->stok_id) }}">
                    @csrf
                    @method('PUT')

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
                        <label>Satuan</label>
                        <input type="text" name="satuan" value="{{ $data->satuan }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kuantitas</label>
                        <input type="number" name="kuantitas" value="{{ $data->kuantitas }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Terpakai</label>
                        <input type="number" name="terpakai" value="{{ $data->terpakai }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Sisa</label>
                        <input type="number" name="sisa" value="{{ $data->sisa }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $data->keterangan }}</textarea>
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
