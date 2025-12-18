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
            {{-- BAR CHART LAMA --}}
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
        <div class="card-body d-flex flex-column align-items-center justify-content-center"
             style="height: 350px;">
            
            <canvas id="statusChart" style="max-width: 300px;"></canvas>

            <div class="mt-3">
                <span class="badge bg-success me-2">ON: {{ $on }}</span>
                <span class="badge bg-danger">OFF: {{ $off }}</span>
            </div>
        </div>
    </div>
</div>


            {{-- BAR CHART ON OFF PER WILAYAH --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Titik Lokasi ON & OFF per Wilayah</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="onOffWilayahChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="col-md-12 mb-2">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="wilayah" class="form-control">
                                <option value="">Semua Wilayah</option>
                                @foreach ($wilayahList as $w)
                                    <option value="{{ $w->id_wilayah }}"
                                        {{ $wilayahId == $w->id_wilayah ? 'selected' : '' }}>
                                        {{ $w->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- BAR CHART SERVER PER TAHUN --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Server per Tahun Pengadaan</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="serverPerTahunChart"></canvas>
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

    new Chart(document.getElementById('wilayahChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Titik Lokasi',
                data: {!! json_encode($jumlah) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

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
        }
    });

    new Chart(document.getElementById('onOffWilayahChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'ON',
                    data: {!! json_encode($onPerWilayah) !!},
                    backgroundColor: 'rgba(40, 167, 69, 0.7)'
                },
                {
                    label: 'OFF',
                    data: {!! json_encode($offPerWilayah) !!},
                    backgroundColor: 'rgba(220, 53, 69, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('serverPerTahunChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($tahunLabels) !!},
            datasets: [{
                label: 'Jumlah Server',
                data: {!! json_encode($jumlahServer) !!},
                backgroundColor: 'rgba(255, 193, 7, 0.7)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

});
</script>
@endsection
