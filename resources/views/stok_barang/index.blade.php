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

                <a href="{{ route('stok_barang.exportPdf') }}" class="btn btn-danger">
                    Export PDF
                </a>
            </div>

            <div class="card-body">

                @if($asetTua > 0)
                    <div class="alert alert-warning">
                        ⚠️ Terdapat <strong>{{ $asetTua }}</strong> stok barang yang berusia lebih dari 5 tahun.
                        <ul class="mt-2 mb-0">
                            @foreach($asetTuaData as $row)
                                <li>{{ $row->barang->nama_barang }}</li>
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
                                <th>KETERANGAN</th>
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
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
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

