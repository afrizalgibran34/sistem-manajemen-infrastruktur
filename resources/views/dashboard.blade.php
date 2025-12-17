@extends('layouts.app', [
    'activePage' => 'dashboard',
    'title' => 'Dashboard',
    'navName' => 'Data Analisis',
    'activeButton' => 'Dashboard'
])

@section('content')
<div class="p-4">
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="card">
        <div class="card-header">
            Grafik Stok Barang
        </div>
        <div class="card-body">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>
</div>

{{-- CDN ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('dashboardChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(
                $data->map(fn($row) => optional($row->barang)->nama_barang)
            ) !!},
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
                    data: {!! json_encode($data->pluck('sisa')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
