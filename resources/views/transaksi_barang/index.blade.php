@extends('layouts.app', [
    'activePage' => 'transaksi_barang',
    'title' => __('Data Barang Keluar'),
    'navName' => 'Data Barang Keluar',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <a href="{{ route('transaksi_barang.create') }}" class="btn btn-primary mb-3">
            + Tambah Transaksi
        </a>

        <div class="card strpied-tabled-with-hover">

            <div class="card-header">
                <h4 class="card-title">Data Barang Keluar</h4>
                <p class="card-category">Catatan keluar barang per lokasi</p>
            </div>

            <div class="card-body">
                {{-- Entries Dropdown --}}
                <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-sm text-gray-600">Show</label>
                        <select id="entriesSelect" class="form-select form-select-sm" style="width: 80px;" onchange="changeEntries(this.value)">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <label class="mb-0 text-sm text-gray-600">entries</label>
                    </div>
                    <div class="text-sm text-gray-600">
                        Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() }} entries
                    </div>
                </div>

                <div class="table-responsive">

                <table class="table table-hover table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->transaksi_id }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->keterangan }}</td>

                            <td class="text-center">

                                <a href="{{ route('transaksi_barang.edit', $row->transaksi_id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('transaksi_barang.destroy', $row->transaksi_id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf @method('DELETE')
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

    </div>
</div>

<script>
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page'); // Reset to page 1
    window.location.href = url.toString();
}
</script>
@endsection
