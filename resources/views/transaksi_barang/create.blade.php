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
            <div class="card-header">
                <h4 class="card-title">Input Barang Keluar</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('transaksi_barang.store') }}">
                    @csrf

                    {{-- Tanggal --}}
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input
                            type="date"
                            name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal') }}"
                            required
                        >
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Titik Lokasi --}}
                    <div class="form-group">
                        <label>Titik Lokasi</label>
                        <select
                            name="lokasi_id"
                            class="form-control @error('lokasi_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Titik Lokasi --</option>
                            @foreach ($titik as $t)
                                <option value="{{ $t->id_titik }}"
                                    {{ old('lokasi_id') == $t->id_titik ? 'selected' : '' }}>
                                    {{ $t->nama_titik }}
                                </option>
                            @endforeach
                        </select>
                        @error('lokasi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Barang --}}
                    <div class="form-group">
                        <label>Barang</label>
                        <select
                            name="barang_id"
                            class="form-control @error('barang_id') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}"
                                    {{ old('barang_id') == $b->barang_id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div class="form-group">
                        <label>Jumlah Keluar</label>
                        <input
                            type="number"
                            name="jumlah"
                            class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ old('jumlah', 1) }}"
                            min="1"
                            required
                        >
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea
                            name="keterangan"
                            class="form-control @error('keterangan') is-invalid @enderror"
                            rows="3"
                        >{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('transaksi_barang.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
