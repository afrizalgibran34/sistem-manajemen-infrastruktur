@extends('layouts.app', [
    'activePage' => 'stok_barang',
    'title' => __('Tambah Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Stok Barang</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('stok_barang.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Barang</label>
                        <select name="barang_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Kuantitas</label>
                        <input type="number" name="kuantitas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Terpakai</label>
                        <input type="number" name="terpakai" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Sisa</label>
                        <input type="number" name="sisa" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
