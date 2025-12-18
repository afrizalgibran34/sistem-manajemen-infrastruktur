@extends('layouts.app', [
    'activePage' => 'titik_lokasi_index',
    'title' => __('Data Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- ================= TABLE ================= --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0">Data Titik Lokasi</h4>
                            <p class="card-category mb-0">
                                Semua titik lokasi jaringan
                            </p>
                        </div>

                        <a href="{{ route('titik_lokasi.exportPdf') }}" class="btn btn-danger">
                            Export PDF
                        </a>
                    </div>

                    <div class="card-body">

                        {{-- Entries --}}
                        <div class="d-flex justify-content-between align-items-center mb-3 px-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="mb-0">Show</label>
                                <select class="form-select form-select-sm"
                                        style="width:80px"
                                        onchange="changeEntries(this.value)">
                                    @foreach ([5,10,25,50,100] as $n)
                                        <option value="{{ $n }}" {{ request('per_page',10) == $n ? 'selected' : '' }}>
                                            {{ $n }}
                                        </option>
                                    @endforeach
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
                                        <th>TITIK LOKASI</th>
                                        <th>WILAYAH</th>
                                        <th>PD / UNIT</th>
                                        <th>KLASIFIKASI</th>
                                        <th>KONEKSI</th>
                                        <th>PANJANG FO (m)</th>
                                        <th>TAHUN PEMBANGUNAN</th>
                                        <th>STATUS</th>
                                        <th>BACKBONE</th>
                                        <th>UPLINK</th>
                                        <th>PERANGKAT</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration + ($data->currentPage()-1)*$data->perPage() }}</td>
                                        <td>{{ $row->nama_titik }}</td>
                                        <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                        <td>{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
                                        <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
                                        <td>{{ $row->koneksi }}</td>

                                        {{-- PANJANG FO --}}
                                        <td>
                                            @if($row->koneksi === 'FO')
                                                {{ $row->panjang_fo ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        {{-- TAHUN --}}
                                        <td>{{ $row->tahun_pembangunan }}</td>

                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->backbone->jenis_backbone ?? '-' }}</td>
                                        <td>{{ $row->uplink->jenis_uplink ?? '-' }}</td>
                                        <td>{{ $row->perangkat }}</td>

                                        <td>
                                            <a href="{{ route('titik_lokasi.edit', $row->id_titik) }}"
                                               class="btn btn-warning btn-sm mb-1">Edit</a>

                                            <form action="{{ route('titik_lokasi.destroy', $row->id_titik) }}"
                                                  method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin hapus?')"
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

                        {{ $data->links() }}

                    </div>
                </div>

            </div>
        </div>
<<<<<<< HEAD
        {{-- ========================================= --}}
=======

>>>>>>> feature-crud-backend
    </div>
</div>
@endsection

<<<<<<< HEAD
<script>
=======
{{-- ================= SCRIPT ================= --}}
@push('scripts')
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
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});

>>>>>>> feature-crud-backend
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>
@endpush
