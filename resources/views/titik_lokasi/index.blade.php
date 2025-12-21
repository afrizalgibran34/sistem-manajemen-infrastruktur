@extends('layouts.app', [
    'activePage' => 'titik_lokasi_index',
    'title' => __('Data Titik Lokasi'),
    'navName' => 'Titik Lokasi',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- ================= JUDUL ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="mb-1 text-2xl md:text-3xl font-bold">Data Titik Lokasi</h2>
                <p class="text-muted text-sm md:text-base">Semua titik lokasi jaringan</p>
            </div>
        </div>

        {{-- ================= FILTER ================= --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('titik_lokasi.index') }}" class="row g-3">
                            <div class="col-md-4 col-12">
                                <label for="search" class="form-label">Cari Nama Titik Lokasi</label>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       class="form-control rounded-md border-gray-300"
                                       value="{{ request('search') }}"
                                       placeholder="Masukkan nama titik lokasi">
                            </div>
                            <div class="col-md-2 col-12">
                                <label for="id_wilayah" class="form-label">Filter Wilayah</label>
                                <select name="id_wilayah" id="id_wilayah" class="form-control rounded-md border-gray-300">
                                    <option value="">-- Semua Wilayah --</option>
                                    @foreach ($wilayahList ?? [] as $w)
                                        <option value="{{ $w->id_wilayah }}" {{ request('id_wilayah') == $w->id_wilayah ? 'selected' : '' }}>
                                            {{ $w->nama_wilayah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-12">
                                <label for="status" class="form-label">Filter Status</label>
                                <select name="status" id="status" class="form-control rounded-md border-gray-300">
                                    <option value="">-- Semua Status --</option>
                                    <option value="On" {{ request('status') == 'On' ? 'selected' : '' }}>On</option>
                                    <option value="Off" {{ request('status') == 'Off' ? 'selected' : '' }}>Off</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="tahun_dari" class="form-label">Tahun Dari</label>
                                <input type="number"
                                       name="tahun_dari"
                                       id="tahun_dari"
                                       class="form-control rounded-md border-gray-300"
                                       value="{{ request('tahun_dari') }}"
                                       min="1900"
                                       max="{{ date('Y') }}">
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="tahun_sampai" class="form-label">Tahun Sampai</label>
                                <input type="number"
                                       name="tahun_sampai"
                                       id="tahun_sampai"
                                       class="form-control rounded-md border-gray-300"
                                       value="{{ request('tahun_sampai') }}"
                                       min="1900"
                                       max="{{ date('Y') }}">
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('titik_lokasi.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">
                    <div class="card-header d-flex justify-content-end align-items-center">
                        <a href="{{ route('titik_lokasi.exportPdf', request()->query()) }}" target="_blank" class="btn btn-danger">
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
                                    @forelse ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration + ($data->currentPage()-1)*$data->perPage() }}</td>
                                        <td>{{ $row->nama_titik }}</td>
                                        <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                        <td>{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
                                        <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
                                        <td>{{ $row->koneksi }}</td>

                                        <td>
                                            {{ $row->koneksi === 'FO' ? ($row->panjang_fo ?? '-') : '-' }}
                                        </td>

                                        <td>{{ $row->tahun_pembangunan }}</td>
                                        <td>
                                            @if($row->status === 'On')
                                                <span class="badge bg-primary">ON</span>
                                            @else
                                                <span class="badge bg-danger">OFF</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->backbone->jenis_backbone ?? '-' }}</td>
                                        <td>{{ $row->uplink->jenis_uplink ?? '-' }}</td>
                                        <td>{{ $row->perangkat }}</td>

                                        <td>
                                            <a href="{{ route('titik_lokasi.edit', $row->id_titik) }}"
                                               class="btn btn-warning btn-sm mb-1">Edit</a>

                                           <form action="{{ route('titik_lokasi.destroy', $row->id_titik) }}"
                                                method="POST"
                                                style="display:inline-block">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-danger btn-sm btn-delete">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center py-4">
                                            <i class="nc-icon nc-zoom-split" style="font-size:48px; opacity:.3"></i>
                                            <p class="mb-0 mt-2">Tidak ada data</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $data->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

{{-- ================= SCRIPT ================= --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>
@endpush