@extends('layouts.app', [
    'activePage' => 'stok_barang_create',
    'title' => __('Tambah Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Input Stok Barang</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('stok_barang.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Barang --}}
                    <div class="form-group mb-3">
                        <label>Barang <span style="color: red;">*</span></label>
                        <select name="barang_id"
                                id="barang_id"
                                class="form-control rounded-md border-gray-300"
                                required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->barang_id }}">
                                    {{ $b->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

               <div class="form-group mb-3" id="jenis-barang-wrapper" style="display:none;">
                    <label>Jenis Barang</label>
                    <input type="text"
                        id="jenis_barang"
                        class="form-control rounded-md border-gray-300"
                        readonly>
                </div>



                    {{-- Satuan --}}
                    <div class="form-group mb-3">
                        <label>Satuan <span style="color: red;">*</span></label>
                        <input type="text"
                               name="satuan"
                               class="form-control rounded-md border-gray-300"
                               required>
                    </div>

                    {{-- Kuantitas --}}
                    <div class="form-group mb-3">
                        <label>Kuantitas <span style="color: red;">*</span></label>
                        <input type="number"
                               name="kuantitas"
                               class="form-control rounded-md border-gray-300"
                               min="1"
                               required>
                    </div>
                <div class="form-group mb-3">
                    <label>Kondisi Barang</label>
                    <input type="text" name="kondisi" class="form-control rounded-md border-gray-300"
                        placeholder="Contoh: Baik / Rusak / Perlu Perbaikan">
                </div>

                <div class="form-group mb-3">
                    <label>Spesifikasi Barang</label>
                    <textarea name="spesifikasi" class="form-control rounded-md border-gray-300" rows="3"
                            placeholder="Spesifikasi singkat barang"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Tahun Pengadaan</label>
                    <input type="number" name="tahun_pengadaan"
                        class="form-control rounded-md border-gray-300"
                        placeholder="Contoh: 2022">
                </div>


                    {{-- Keterangan --}}
                    <div class="form-group mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                  class="form-control rounded-md border-gray-300"
                                  rows="3"
                                  ></textarea>
                    </div>
                    <div class="form-group mb-2">
                    <label>Foto Barang</label>
                    <div class="mt-2">
                        <img id="preview-image"
                            src=""
                            alt="Preview Foto"
                            style="display:none; max-width:200px;"
                            class="img-thumbnail">
                    </div>
                    <input type="file"
                        name="foto"
                        class="form-control rounded-md border-gray-300"
                        accept="image/*"
                        onchange="previewFoto(this)">
                </div>

                    {{-- Tombol --}}
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('stok_barang.index') }}"
                       class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

<script>
function previewFoto(input) {
    const preview = document.getElementById('preview-image');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const barangSelect = document.getElementById('barang_id');
    const wrapper = document.getElementById('jenis-barang-wrapper');
    const inputJenis = document.getElementById('jenis_barang');

    if (!barangSelect) {
        console.error('Element barang_id tidak ditemukan');
        return;
    }

    barangSelect.addEventListener('change', function () {
        const barangId = this.value;

        if (!barangId) {
            wrapper.style.display = 'none';
            inputJenis.value = '';
            return;
        }

        fetch(`/barang/${barangId}/jenis`)
            .then(response => response.json())
            .then(data => {
                inputJenis.value = data.jenis_barang ?? '-';
                wrapper.style.display = 'block';
            })
            .catch(err => {
                console.error('Gagal ambil jenis barang:', err);
            });
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const barangSelect = document.getElementById('barang_id');
    const wrapper = document.getElementById('jenis-barang-wrapper');
    const inputJenis = document.getElementById('jenis_barang');

    if (!barangSelect) {
        console.error('Select barang_id tidak ditemukan');
        return;
    }

    barangSelect.addEventListener('change', async function () {
        const barangId = this.value;

        if (!barangId) {
            wrapper.style.display = 'none';
            inputJenis.value = '';
            return;
        }

        try {
            const response = await fetch(`/barang/${barangId}/jenis`);
            const data = await response.json();

            inputJenis.value = data.jenis_barang ?? '-';
            wrapper.style.display = 'block';

        } catch (error) {
            console.error('Gagal ambil jenis barang:', error);
        }
    });

});
</script>

