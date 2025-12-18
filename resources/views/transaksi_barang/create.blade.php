@extends('layouts.app', [
    'activePage' => 'barang_keluar',
    'title' => __('Input Barang Keluar'),
    'navName' => 'Input Barang Keluar',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Input Barang Keluar</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('transaksi_barang.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                      <div class="form-group">
                        <label>Titik Lokasi</label>
                        <select name="lokasi_id" class="form-control" required>
                            <option value="">-- Pilih Titik Lokasi --</option>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}">
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                    </div>

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
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('transaksi_barang.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
