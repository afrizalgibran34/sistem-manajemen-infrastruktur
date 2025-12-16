@extends('layouts.app', [
    'activePage' => 'barang',
    'title' => __('Edit Barang'),
    'navName' => 'Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Edit Barang</h4></div>

            <div class="card-body">

                <form method="POST" action="{{ route('barang.update', $data->barang_id) }}">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ $data->nama_barang }}" class="form-control" required>
                    </div>

                    <select name="jenis_barang" class="form-control" required>
                        <option value="Perangkat FO"
                            {{ $barang->jenis_barang == 'Perangkat FO' ? 'selected' : '' }}>
                            Perangkat FO
                        </option>
                        <option value="Perangkat Wireless"
                            {{ $barang->jenis_barang == 'Perangkat Wireless' ? 'selected' : '' }}>
                            Perangkat Wireless
                        </option>
                        <option value="Perangkat LAN"
                            {{ $barang->jenis_barang == 'Perangkat LAN' ? 'selected' : '' }}>
                            Perangkat LAN
                        </option>
                    </select>


                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
