@extends('layouts.app', [
    'activePage' => 'dashboard',
    'title' => __('Dashboard'),
    'navName' => 'Dashboard',
    'activeButton' => 'Dashboard'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            {{-- BAR CHART --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Titik Lokasi per Wilayah</h4>
                    </div>
                    <div class="card-body" style="height: 350px;">
                        <canvas id="wilayahChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- PIE CHART --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Status Titik Lokasi</h4>
                    </div>
                    <div class="card-body text-center" style="height: 350px;">
                        <canvas id="statusChart"></canvas>

                        <div class="mt-3">
                            <span class="badge bg-success me-2">ON: {{ $on }}</span>
                            <span class="badge bg-danger">OFF: {{ $off }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // BAR CHART
    new Chart(document.getElementById('wilayahChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Titik Lokasi',
                data: {!! json_encode($jumlah) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                barPercentage: 0.8,
                categoryPercentage: 0.9
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    offset: true,
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // PIE CHART
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['ON', 'OFF'],
            datasets: [{
                data: [{{ $on }}, {{ $off }}],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(220, 53, 69, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>
@endsection
