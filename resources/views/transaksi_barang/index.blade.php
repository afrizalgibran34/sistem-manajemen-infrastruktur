@extends('layouts.app', [
    'activePage' => 'barang_keluar',
    'title' => __('Data Barang Keluar'),
    'navName' => 'Data Barang Keluar',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card strpied-tabled-with-hover">

            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Data Barang Keluar</h4>
                    <p class="card-category mb-0">Catatan keluar barang per lokasi</p>
                </div>

                <div>
                    <a href="{{ route('transaksi_barang.create') }}"
                    class="btn btn-primary btn-sm mr-2">
                        Input Barang Keluar
                    </a>

                    <a href="{{ route('transaksi_barang.pdf') }}"
                    target="_blank"
                    class="btn btn-danger btn-sm">
                        Export PDF
                    </a>
                </div>
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

                <table class="table table-hover table-striped align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Titik / Lokasi Layanan</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($data->currentPage()-1)*$data->perPage() }}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->titik_lokasi->nama_titik ?? '-' }}</td>
                            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->keterangan }}</td>

                            <td class="text-center">

                                <a href="{{ route('transaksi_barang.edit', $row->transaksi_id) }}"
                                   class="btn btn-warning btn-sm mb-2">
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
