@extends('layouts.app', [
    'activePage' => 'dashboard',
    'title' => __('Dashboard'),
    'navName' => 'Dashboard',
    'activeButton' => 'Dashboard'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- ================= RINGKASAN UTAMA ================= --}}
        <div class="row mb-4">

            {{-- Jumlah Titik per Wilayah --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Titik Lokasi per Wilayah</h4>
                    </div>
                    <div class="card-body chart-md">
                        <canvas id="wilayahChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Status Titik Lokasi</h4>
                    </div>
                    <div class="card-body chart-md text-center">
                        <canvas id="statusChart" class="mb-3"></canvas>
                        <span class="badge bg-success me-2">ON: {{ $on }}</span>
                        <span class="badge bg-danger">OFF: {{ $off }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= ON OFF PER WILAYAH ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Titik Lokasi ON & OFF per Wilayah</h4>
                    </div>
                    <div class="card-body chart-lg">
                        <canvas id="onOffWilayahChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= FILTER WILAYAH ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('dashboard') }}" class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Filter Wilayah</label>
                                <select name="wilayah" class="form-control">
                                    <option value="">Semua Wilayah</option>
                                    @foreach ($wilayahList as $w)
                                        <option value="{{ $w->id_wilayah }}" {{ $wilayahId == $w->id_wilayah ? 'selected' : '' }}>
                                            {{ $w->nama_wilayah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= SERVER ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Server per Tahun Pengadaan</h4>
                    </div>
                    <div class="card-body chart-lg">
                        <canvas id="serverPerTahunChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= FO ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('dashboard') }}" class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Analisis Kabel FO</label>
                                <select name="fo_mode" class="form-control">
                                    <option value="">Pilih Mode</option>
                                    <option value="id_wilayah" {{ request('fo_mode')=='id_wilayah' ? 'selected' : '' }}>Wilayah</option>
                                    <option value="id_titik" {{ request('fo_mode')=='id_titik' ? 'selected' : '' }}>Titik Lokasi</option>
                                    <option value="tahun_pembangunan" {{ request('fo_mode')=='tahun_pembangunan' ? 'selected' : '' }}>Tahun</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Terapkan</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body chart-lg">
                        <canvas id="foChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= GANGGUAN ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Analisis Gangguan Jaringan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Berdasarkan</label>
                                <select id="gangguanMode" class="form-control">
                                    <option value="jenis_koneksi">Jenis Koneksi</option>
                                    <option value="wilayah">Wilayah</option>
                                    <option value="titik">Titik Lokasi</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dari</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sampai</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" id="applyGangguanFilter">
                                    Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body chart-lg">
                        <canvas id="gangguanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ================= CHART LAMA (TETAP) ================= */
    new Chart(wilayahChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Titik Lokasi',
                data: {!! json_encode($jumlah) !!},
                backgroundColor: 'rgba(54,162,235,.7)'
            }]
        },
        options: { responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });

    new Chart(statusChart, {
        type: 'pie',
        data: {
            labels: ['ON','OFF'],
            datasets: [{
                data: [{{ $on }}, {{ $off }}],
                backgroundColor:['rgba(40,167,69,.7)','rgba(220,53,69,.7)']
            }]
        }
    });

    new Chart(onOffWilayahChart, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                { label:'ON', data:{!! json_encode($onPerWilayah) !!}, backgroundColor:'rgba(40,167,69,.7)' },
                { label:'OFF', data:{!! json_encode($offPerWilayah) !!}, backgroundColor:'rgba(220,53,69,.7)' }
            ]
        },
        options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });

    new Chart(serverPerTahunChart, {
        type:'bar',
        data:{
            labels:{!! json_encode($tahunLabels) !!},
            datasets:[{ label:'Jumlah Server', data:{!! json_encode($jumlahServer) !!}, backgroundColor:'rgba(255,193,7,.7)' }]
        },
        options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });

    @if(!empty($foLabels))
    new Chart(foChart, {
        type:'bar',
        data:{
            labels:{!! json_encode($foLabels) !!},
            datasets:[{ label:'Panjang Kabel FO (meter)', data:{!! json_encode($foData) !!}, backgroundColor:'rgba(102,16,242,.7)' }]
        },
        options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });
    @endif


    /* ================= CHART GANGGUAN (BARU) ================= */
    let gangguanChart;

    function loadGangguanChart() {
        const mode = document.getElementById('gangguanMode').value;
        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;

        let params = { mode };

        if (start && end) {
            params.start_date = start;
            params.end_date = end;
        }

        axios.get('/api/gangguan/chart', { params })
            .then(res => {
                const data = res.data;

                if (gangguanChart) gangguanChart.destroy();

                gangguanChart = new Chart(
                    document.getElementById('gangguanChart'),
                    {
                        type: data.chart_type,
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: data.label,
                                data: data.values,
                                backgroundColor: 'rgba(13,110,253,.7)'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true } }
                        }
                    }
                );
            })
            .catch(err => console.error(err));
    }

    document.getElementById('applyGangguanFilter')
        .addEventListener('click', loadGangguanChart);

    loadGangguanChart();
});
</script>
