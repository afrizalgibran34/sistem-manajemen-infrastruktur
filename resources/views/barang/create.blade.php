@extends('layouts.app', [
    'activePage' => 'barang',
    'title' => __('Tambah Barang'),
    'navName' => 'Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header"><h4 class="card-title">Tambah Barang</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('barang.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nama Barang <span style="color: red;">*</span></label>
                        <input type="text" name="nama_barang" class="form-control rounded-md border-gray-300" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Jenis Barang <span style="color: red;">*</span></label>
                        <select name="jenis_barang" class="form-control rounded-md border-gray-300" required>
                            <option value="">-- Pilih Jenis Barang --</option>
                            <option value="Perangkat FO">Perangkat FO</option>
                            <option value="Perangkat Wireless">Perangkat Wireless</option>
                            <option value="Perangkat LAN">Perangkat LAN</option>
                        </select>
                    </div>


                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
