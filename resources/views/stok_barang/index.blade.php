@extends('layouts.app', [
    'activePage' => 'stok_barang',
    'title' => __('Stok Barang'),
    'navName' => 'Stok Barang',
    'activeButton' => 'dataStok'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- CARD GRAFIK DIATAS --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title">Grafik Pemakaian Stok</h4>
            </div>
            <div class="card-body">
                <canvas id="stokChart"></canvas>
            </div>
        </div>

        {{-- TOMBOL TAMBAH --}}
        <a href="{{ route('stok_barang.create') }}" class="btn btn-primary mb-3">+ Tambah Stok Barang</a>

        {{-- TABEL --}}
        <div class="card strpied-tabled-with-hover">

            <div class="card-header">
                <h4 class="card-title">Data Stok Barang</h4>
                <p class="card-category">Daftar stok barang beserta pemakaian & sisa</p>
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
                            <th>Nama Barang</th>
                            <th>Kuantitas</th>
                            <th>Terpakai</th>
                            <th>Sisa</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->stok_id }}</td>
                            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $row->kuantitas }}</td>
                            <td>{{ $row->terpakai }}</td>
                            <td>{{ $row->sisa }}</td>
                            <td>{{ $row->keterangan }}</td>

                            <td class="text-center">
                                <a href="{{ route('stok_barang.edit', $row->stok_id) }}"
                                   class="btn btn-warning btn-sm mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('stok_barang.destroy', $row->stok_id) }}"
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

{{-- CDN ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- SCRIPT GRAFIK --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('stokChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($data->pluck('barang')->pluck('nama_barang')) !!},
            datasets: [
                {
                    label: 'Kuantitas',
                    data: {!! json_encode($data->pluck('kuantitas')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                    label: 'Terpakai',
                    data: {!! json_encode($data->pluck('terpakai')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
                {
                    label: 'Sisa',
                    data: {!! json_encode($data->pluck('sisa')) !!}
                    ,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
