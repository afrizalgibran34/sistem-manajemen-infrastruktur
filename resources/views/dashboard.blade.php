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

            {{-- BAR CHART JUMLAH TITIK PER WILAYAH --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header bg-gradient-primary text-white" style="border-radius: 15px 15px 0 0;">
                        <h4 class="card-title mb-0 font-weight-bold">Jumlah Titik Lokasi per Wilayah</h4>
                    </div>
                    <div class="card-body" style="height: 350px;">
                        <canvas id="wilayahChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- PIE CHART STATUS --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header bg-gradient-success text-white" style="border-radius: 15px 15px 0 0;">
                        <h4 class="card-title mb-0 font-weight-bold">Status Titik Lokasi</h4>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 350px;">
                        <canvas id="statusChart" style="max-width: 300px;"></canvas>
                        <div>
                             <span class="badge bg-light text-black me-2 shadow-sm" style="border-radius: 20px; padding: 8px 12px;">JUMLAH STATUS: {{ $on + $off }}</span>
                            <span class="badge bg-light text-success me-2 shadow-sm" style="border-radius: 20px; padding: 8px 12px;">ON: {{ $on }} (<span id="persenOn"></span>%)</span>
                            <span class="badge bg-light text-danger shadow-sm" style="border-radius: 20px; padding: 8px 12px;">OFF: {{ $off }} (<span id="persenOff"></span>%)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BAR CHART ON OFF PER WILAYAH --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header bg-gradient-info text-white" style="border-radius: 15px 15px 0 0;">
                        <h4 class="card-title mb-0 font-weight-bold">Titik Lokasi ON & OFF per Wilayah</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="onOffWilayahChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- FILTER WILAYAH --}}
            <div class="col-md-12 mb-2">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="row">
                        <div class="col-md-4">
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
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- BAR CHART SERVER --}}
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

            {{-- PANJANG KABEL FO DAN JUMLAH KABEL FO --}}
            <div class="col-md-12 mb-4">
            <div class="row">
                {{-- STATISTIC CARD PANJANG KABEL FO --}}
                <div class="col-md-5 mb-4 sm:mb-0">
                    <div class="card h-100 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header bg-gradient-warning text-black d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                            <h4 class="card-title mb-0 font-weight-bold">Total Panjang Kabel FO</h4>
                            <select id="fo_filter" class="form-control form-control-sm" style="width: auto; background-color: rgba(255,255,255,0.2);">
                                <option value="">Semua Wilayah</option>
                                    @foreach ($wilayahList as $w)
                                        <option value="{{ $w->id_wilayah }}">{{ $w->nama_wilayah }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center" style="height: 200px;">
                            <div class="text-center">
                                <h1 class="display-4 font-weight-bold text-warning" id="totalFo">0</h1>
                                <p class="mb-0 text-muted">Meter</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PIE CHART JUMLAH KABEL FO --}}
                <div class="col-md-7 mb-4">
                    <div class="card h-100 border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header bg-gradient-danger text-white d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                            <h4 class="card-title mb-0 font-weight-bold">Jumlah Kabel FO dan Wireless</h4>
                            <div class="d-flex gap-2">
                                <select id="wilayahKabel" class="form-control form-control-sm" style="width: auto; background-color: rgba(255,255,255,0.2);">
                                    <option value="">Semua Wilayah</option>
                                    @foreach ($wilayahList as $w)
                                        <option value="{{ $w->id_wilayah }}">{{ $w->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column" style="height: 400px;">
                            <div style="height: 300px;">
                                <canvas id="foPieChart"></canvas>
                            </div>
                            <div class="mt-3 text-center">
                                <span class="badge bg-light text-black me-2 shadow-sm" style="border-radius: 20px; padding: 8px 12px;">Total: <span id="totalKabel">0</span></span>
                                <span class="badge bg-warning text-black me-2 shadow-sm" style="border-radius: 20px; padding: 8px 12px;">FO: <span id="foCount">0</span></span>
                                <span class="badge bg-primary text-white shadow-sm" style="border-radius: 20px; padding: 8px 12px;">Wireless: <span id="wirelessCount">0</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            {{-- ================= FILTER STOK BARANG (BARU) ================= --}}
            <div class="col-md-12 mb-3">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="stok_mode" class="form-control">
                                <option value="besaran" {{ request('stok_mode')=='besaran' ? 'selected' : '' }}>
                                    Besaran / Keseluruhan
                                </option>
                                <option value="tahun_pengadaan" {{ request('stok_mode')=='tahun_pengadaan' ? 'selected' : '' }}>
                                    Berdasarkan Tahun Pengadaan
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">Terapkan</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- CHART STOK BARANG (BARU) --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Stok Barang</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="stokChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- ================= FILTER BARANG KELUAR (BARU) ================= --}}
            <div class="col-md-12 mb-3">
                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="row g-2">
                        <div class="col-md-4">
                        <select name="transaksi_mode" class="form-control">
                            <option value="besaran" {{ request('transaksi_mode')=='besaran' ? 'selected' : '' }}>
                                Besaran / Keseluruhan
                            </option>
                            <option value="tahun_pengadaan" {{ request('transaksi_mode')=='tahun_pengadaan' ? 'selected' : '' }}>
                                Berdasarkan Tahun Pengadaan
                            </option>
                        </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">Terapkan</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- CHART BARANG KELUAR (BARU) --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Jumlah Barang Keluar</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="transaksiChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- ================= FILTER DATA GANGGUAN JARINGAN ================= --}}
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filter Data Gangguan Jaringan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">

                            {{-- MODE ANALISIS --}}
                            <div class="col-md-4">
                                <label class="form-label">Analisis Berdasarkan</label>
                                <select id="gangguanMode" class="form-control">
                                    <option value="jenis_koneksi">Jenis Koneksi</option>
                                    <option value="wilayah">Wilayah</option>
                                    <option value="titik">Titik / Lokasi</option>
                                </select>
                            </div>

                            {{-- FILTER TANGGAL --}}
                            <div class="col-md-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" id="startDate" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" id="endDate" class="form-control">
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-primary w-100" id="applyGangguanFilter">
                                    Terapkan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= CHART DATA GANGGUAN JARINGAN ================= --}}
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Grafik Data Gangguan Jaringan</h4>
                    </div>
                    <div class="card-body" style="height: 400px;">
                        <canvas id="gangguanChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener("DOMContentLoaded", function () {

    /* ================= BAR CHART WILAYAH - DENGAN ANGKA DI ATAS BAR ================= */
    const ctxWilayah = document.getElementById('wilayahChart').getContext('2d');
    const gradientWilayah = ctxWilayah.createLinearGradient(0, 0, 0, 400);
    gradientWilayah.addColorStop(0, '#2D68C4');
    gradientWilayah.addColorStop(1, '#4682B4');

    new Chart(ctxWilayah, {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Jumlah Titik Lokasi',
            data: {!! json_encode($jumlah) !!},
            backgroundColor: gradientWilayah,
            borderWidth: 1,
            borderRadius: 2,
            borderSkipped: false,
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,

        // 🔑 TAMBAH RUANG ATAS
        layout: {
            padding: {
                top: 30
            }
        },

        scales: { 
            y: { 
                beginAtZero: true,

                // 🔑 kasih ruang ke atas tanpa menampilkan sumbu
                grace: '15%',

                ticks: {
                    display: false
                },
                grid: {
                    display: false
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    },
    plugins: [{
        afterDatasetsDraw: function(chart) {
            const ctx = chart.ctx;
            ctx.save();

            chart.data.datasets.forEach((dataset, i) => {
                const meta = chart.getDatasetMeta(i);
                meta.data.forEach((bar, index) => {
                    const data = dataset.data[index];

                    ctx.fillStyle = '#333';
                    ctx.font = 'bold 12px Arial';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    // 🔑 geser angka sedikit ke atas
                    ctx.fillText(data, bar.x, bar.y - 8);
                });
            });

            ctx.restore();
        }
    }]
});


    /* ================= PIE CHART STATUS - DENGAN PERSENTASE ================= */
    const totalTitik = {{ $on + $off }};
    const persenOn = totalTitik > 0 ? ({{ $on }} / totalTitik * 100).toFixed(1) : 0;
    const persenOff = totalTitik > 0 ? ({{ $off }} / totalTitik * 100).toFixed(1) : 0;

    // Update badge dengan persentase
    document.getElementById('persenOn').textContent = persenOn;
    document.getElementById('persenOff').textContent = persenOff;

    const ctxStatus = document.getElementById('statusChart').getContext('2d');

    new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: ['ON', 'OFF'],
            datasets: [{
                data: [{{ $on }}, {{ $off }}],
                backgroundColor: ['#4CAF50', '#FF5722'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const percent = totalTitik > 0 ? (value / totalTitik * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percent + '%)';
                        }
                    }
                }
            }
        },
        plugins: [{
            afterDatasetsDraw: function(chart) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((arc, index) => {
                        const data = dataset.data[index];
                        const percent = totalTitik > 0 ? (data / totalTitik * 100).toFixed(1) : 0;
                        
                        const midAngle = (arc.startAngle + arc.endAngle) / 2;
                        const x = arc.x + Math.cos(midAngle) * (arc.outerRadius * 0.7);
                        const y = arc.y + Math.sin(midAngle) * (arc.outerRadius * 0.7);
                        
                        ctx.fillStyle = '#fff';
                        ctx.font = 'bold 14px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(percent + '%', x, y);
                    });
                });
            }
        }]
    });

    /* ================= BAR CHART ON OFF PER WILAYAH ================= */
    new Chart(document.getElementById('onOffWilayahChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                { 
                    label:'ON', 
                    data:{!! json_encode($onPerWilayah) !!}, 
                    backgroundColor:'#4CAF50',
                    borderColor: '#388E3C',
                    borderWidth: 1,
                    borderRadius: 2,
                    borderSkipped: false
                },
                { 
                    label:'OFF', 
                    data:{!! json_encode($offPerWilayah) !!}, 
                    backgroundColor:'#F44336',
                    borderColor: '#D32F2F',
                    borderWidth: 1,
                    borderRadius: 2,
                    borderSkipped: false
                }
            ]
        },
        options:{ 
            responsive:true, 
            maintainAspectRatio:false, 
            scales:{ 
                y:{ 
                    beginAtZero:true,
                    ticks: { display: false },
                    grid: { display: false }
                },
                x: { grid: { display: false } }
            },
            plugins: {
                legend: { display: true, position: 'top' }
            }
        },
        plugins: [{
            afterDatasetsDraw: function(chart) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((bar, index) => {
                        const data = dataset.data[index];
                        ctx.fillStyle = '#333';
                        ctx.font = 'bold 12px Arial';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        ctx.fillText(data, bar.x, bar.y - 8);
                    });
                });
            }
        }]
    });

    /* ================= BAR CHART SERVER PER TAHUN ================= */
    new Chart(document.getElementById('serverPerTahunChart'), {
        type:'bar',
        data:{
            labels:{!! json_encode($tahunLabels) !!},
            datasets:[{ label:'Jumlah Server', data:{!! json_encode($jumlahServer) !!}, backgroundColor:'rgba(255,193,7,.7)' }]
        },
        options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });

    /* ================= FO PIE CHART DAN STATISTIC ================= */
    let foPieChart;

    function loadFoPieChart() {
        const wilayah = document.getElementById('wilayahKabel').value;

        // AJAX call to get data
        axios.get('/api/dashboard/cable-chart', {
            params: { wilayah: wilayah }
        })
        .then(function (response) {
            const data = [response.data.fo, response.data.wireless];
            const labels = ['FO', 'Wireless'];

            if (foPieChart) foPieChart.destroy();

            foPieChart = new Chart(document.getElementById('foPieChart'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF9800', '#2196F3'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });

            // Update badges
            document.getElementById('totalKabel').textContent = response.data.fo + response.data.wireless;
            document.getElementById('foCount').textContent = response.data.fo;
            document.getElementById('wirelessCount').textContent = response.data.wireless;
        })
        .catch(function (error) {
            console.error('Error loading cable chart:', error);
            // Fallback to placeholder
            const data = [50, 30];
            const labels = ['FO', 'Wireless'];

            if (foPieChart) foPieChart.destroy();

            foPieChart = new Chart(document.getElementById('foPieChart'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF9800', '#2196F3'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });

            // Update badges with fallback
            document.getElementById('totalKabel').textContent = '80';
            document.getElementById('foCount').textContent = '50';
            document.getElementById('wirelessCount').textContent = '30';
        });
    }

    // Initial load
    loadFoPieChart();

    // Event listeners for filters
    document.getElementById('wilayahKabel').addEventListener('change', loadFoPieChart);

    // Update total FO
    @if(!empty($foData))
        document.getElementById('totalFo').textContent = '{!! number_format(array_sum($foData), 0, ",", ".") !!}';
    @else
        document.getElementById('totalFo').textContent = '0';
    @endif

    // Event listener for fo_filter (statistic card filter)
    document.getElementById('fo_filter').addEventListener('change', function() {
        const wilayah = this.value;
        axios.get('/api/dashboard/fo-total', {
            params: { wilayah: wilayah }
        })
        .then(function (response) {
            document.getElementById('totalFo').textContent = response.data.total;
        })
        .catch(function (error) {
            console.error('Error loading FO total:', error);
        });
    });

    /* ================= CHART STOK BARANG (BARU) ================= */
    @if(!empty($stokLabels))
    new Chart(document.getElementById('stokChart'), {
        type:'bar',
        data:{
            labels:{!! json_encode($stokLabels) !!},
            datasets:[{ 
                label:'Jumlah Stok', 
                data:{!! json_encode($stokData) !!}, 
                backgroundColor:'rgba(75,192,192,.7)' 
            }]
        },
        options:{ responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }}}
    });
    @endif

    /* ================= CHART BARANG KELUAR (BARU) ================= */
    @if(!empty($transaksiLabels))
    new Chart(document.getElementById('transaksiChart'), {
        type:'bar',
        data:{
            labels:{!! json_encode($transaksiLabels) !!},
            datasets:[{ 
                label:'Jumlah Barang Keluar', 
                data:{!! json_encode($transaksiData) !!}, 
                backgroundColor:'rgba(255,99,132,.7)' 
            }]
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
@endsection