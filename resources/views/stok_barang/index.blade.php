@extends('layouts.app', [
    'activePage' => 'stok_barang_index',
    'title' => __('Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- ================= TABEL ================= --}}
        <div class="card strpied-tabled-with-hover">

            <div class="card-header">
                <h4 class="card-title">Data Stok Barang</h4>
                <p class="card-category">Daftar stok barang beserta pemakaian & sisa</p>
            </div>

            <div class="card-body">
                @if($asetTua > 0)
                <div class="alert alert-warning">
                    ⚠️ Terdapat <strong>{{ $asetTua }}</strong> aset yang berusia lebih dari 5 tahun.
                </div>
                @endif

                {{-- Entries Dropdown --}}
                <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-sm text-gray-600">Show</label>
                        <select class="form-select form-select-sm" style="width: 80px;"
                                onchange="changeEntries(this.value)">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <label class="mb-0 text-sm text-gray-600">entries</label>
                    </div>
                    <div class="text-sm text-gray-600">
                        Showing {{ $data->firstItem() ?? 0 }}
                        to {{ $data->lastItem() ?? 0 }}
                        of {{ $data->total() }} entries
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Kuantitas</th>
                                <th>Satuan</th>
                                <th>Terpakai</th>
                                <th>Sisa</th>
                                <th>Keterangan</th>
                                <th>Foto Barang</th>
                                <th>Kondisi Barang</th>
                                <th>Tahun Pengadaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                                <td>{{ $row->barang->jenis_barang ?? '-' }}</td>
                                <td>{{ $row->kuantitas }}</td>
                                <td>{{ $row->satuan }}</td>
                                <td>{{ $row->terpakai }}</td>
                                <td>{{ $row->sisa }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>
                                    @if ($row->foto)
                                        <img src="{{ asset('storage/'.$row->foto) }}"
                                             width="60" class="img-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $row->kondisi ?? '-' }}</td>
                                <td>{{ $row->tahun_pengadaan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('stok_barang.edit', $row->stok_id) }}"
                                       class="btn btn-warning btn-sm mb-2">
                                        Edit
                                    </a>

                                    <form action="{{ route('stok_barang.destroy', $row->stok_id) }}"
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus data ini?')"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-3 py-3">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        {{-- ========================================= --}}

    </div>
</div>

<script>
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const barangSelect = document.getElementById('barang_id');
    const wrapper = document.getElementById('jenis-barang-wrapper');
    const inputJenis = document.getElementById('jenis_barang');

    if (!barangSelect) return;

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
@endsection
