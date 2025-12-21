@extends('layouts.app', [
    'activePage' => 'stok_barang_index',
    'title' => __('Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card strpied-tabled-with-hover">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Data Stok Barang</h4>
                    <p class="card-category mb-0">
                        Daftar stok barang beserta pemakaian & sisa
                    </p>
                </div>

                <a href="{{ route('stok_barang.exportPdf') }}" target="_blank" class="btn btn-danger">
                    Export PDF
                </a>
            </div>

            <div class="card-body">

                @if(request('barang_id'))
                    @php
                        $filteredBarang = \App\Models\Barang::find(request('barang_id'));
                    @endphp
                    <div class="alert alert-info">
                        📋 Menampilkan stok untuk barang berusia lebih dari 5 tahun: <strong>{{ $filteredBarang->nama_barang ?? 'Tidak ditemukan' }}</strong>
                        <br />
                        <a href="{{ route('stok_barang.index') }}" class="btn btn-sm btn-outline-secondary ms-2 mt-2">Tampilkan Kembali Semua Barang</a>
                    </div>
                @endif

                @if($asetTua > 0)
                    <div class="alert alert-warning">
                        ⚠️ Terdapat <strong>{{ $asetTua }}</strong> stok barang yang berusia lebih dari 5 tahun.
                        <ul class="mt-2 mb-0">
                            @foreach($asetTuaData as $row)
                                <li>
                                    <a href="{{ route('stok_barang.index', ['barang_id' => $row->barang_id]) }}" class="text-decoration-none">
                                        {{ $row->barang->nama_barang }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0">Show</label>
                        <select class="form-select form-select-sm" style="width:80px"
                                onchange="changeEntries(this.value)">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page',10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <label class="mb-0">entries</label>
                    </div>
                    <div>
                        Showing {{ $data->firstItem() ?? 0 }}
                        to {{ $data->lastItem() ?? 0 }}
                        of {{ $data->total() }} entries
                    </div>
                </div>
                                <div class="table-responsive">
                    <table class="table table-hover table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA BARANG</th>
                                <th>JUMLAH</th>
                                <th>TERPAKAI</th>
                                <th>SISA</th>
                                <th>SATUAN</th>
                                <th>KONDISI</th>
                                <th>TAHUN</th>
                                <th>KETERANGAN</th>
                                <th>FOTO</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration + ($data->currentPage()-1)*$data->perPage() }}</td>
                                    <td>{{ $row->barang->nama_barang }}</td>
                                    <td>{{ $row->kuantitas }}</td>
                                    <td>{{ $row->terpakai }}</td>
                                    <td>{{ $row->sisa }}</td>
                                    <td>{{ $row->satuan }}</td>
                                    <td>
                                        {{ $row->kondisi }}
                                    </td>
                                    <td>{{ $row->tahun_pengadaan }}</td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                    <td>
                                        @if($row->foto)
                                            <img src="{{ asset('storage/'.$row->foto) }}"
                                                width="100"
                                                class="img-thumbnail">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('stok_barang.edit', $row->stok_id) }}"
                                        class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('stok_barang.destroy', $row->stok_id) }}"
                                            method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    class="btn btn-danger btn-sm btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        Tidak ada data stok
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                    </table>
                </div>

                {{ $data->links() }}

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>
@endpush

