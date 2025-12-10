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

            <div class="card-body table-full-width table-responsive">

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
        </div>

    </div>
</div>
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
