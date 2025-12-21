@extends('layouts.app', [
    'activePage' => 'stok_barang_index',
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
                <form method="POST"
                    action="{{ route('stok_barang.update', $data->stok_id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Barang</label>
                        <select name="barang_id" class="form-control rounded-md border-gray-300" required>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}"
                                    {{ $data->barang_id == $b->barang_id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Satuan</label>
                        <input type="text" name="satuan"
                            class="form-control rounded-md border-gray-300"
                            value="{{ $data->satuan }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Kuantitas</label>
                        <input type="number" name="kuantitas"
                            class="form-control rounded-md border-gray-300"
                            value="{{ $data->kuantitas }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control rounded-md border-gray-300">{{ $data->keterangan }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Foto Barang</label><br>
                        @if ($data->foto)
                            <img src="{{ asset('storage/'.$data->foto) }}"
                                width="100" class="mb-2">
                        @endif
                        <input type="file" name="foto" class="form-control rounded-md border-gray-300">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kondisi Barang</label>
                        <input type="text" name="kondisi"
                            class="form-control rounded-md border-gray-300"
                            value="{{ $data->kondisi }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>Spesifikasi</label>
                        <textarea name="spesifikasi"
                                class="form-control rounded-md border-gray-300">{{ $data->spesifikasi }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tahun Pengadaan</label>
                        <input type="number" name="tahun_pengadaan"
                            class="form-control rounded-md border-gray-300"
                            value="{{ $data->tahun_pengadaan }}">
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('stok_barang.index') }}" class="btn btn-secondary">Batal</a>
                </form>


            </div>
        </div>

    </div>
</div>
@endsection
