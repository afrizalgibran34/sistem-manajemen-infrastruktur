@extends('layouts.app', [
    'activePage' => 'gangguan_index',
    'title' => __('Laporan Gangguan Jaringan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- ================= JUDUL ================= --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="mb-1 text-2xl md:text-3xl font-bold">Laporan Gangguan Jaringan</h2>
                <p class="text-muted text-sm md:text-base">Rekap semua gangguan berdasarkan titik layanan</p>
            </div>
        </div>

        {{-- ================= FILTER ================= --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('gangguan.index') }}" class="row g-3">
                            <div class="col-md-3 col-12">
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
                            <div class="col-md-3 col-6">
                                <label for="bulan" class="form-label">Filter Bulan</label>
                                <select name="bulan" id="bulan" class="form-control rounded-md border-gray-300">
                                    <option value="">-- Semua Bulan --</option>
                                    @foreach ($bulanList ?? [] as $key => $value)
                                        <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="status_masalah" class="form-label">Filter Status</label>
                                <select name="status_masalah" id="status_masalah" class="form-control rounded-md border-gray-300">
                                    <option value="">-- Semua Status --</option>
                                    <option value="Selesai" {{ request('status_masalah') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Tidak Selesai" {{ request('status_masalah') == 'Tidak Selesai' ? 'selected' : '' }}>Tidak Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                                <input type="date"
                                       name="tanggal_dari"
                                       id="tanggal_dari"
                                       class="form-control rounded-md border-gray-300"
                                       value="{{ request('tanggal_dari') }}"
                                       onclick="this.showPicker()">
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                                <input type="date"
                                       name="tanggal_sampai"
                                       id="tanggal_sampai"
                                       class="form-control rounded-md border-gray-300"
                                       value="{{ request('tanggal_sampai') }}"
                                       onclick="this.showPicker()">
                            </div>
                            <div class="col-12 d-flex flex-wrap align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('gangguan.index') }}" class="btn btn-secondary">Reset</a>
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
                        <a href="{{ route('gangguan.exportPdf', request()->query()) }}" target="_blank" class="btn btn-danger btn-sm">
                            Export PDF
                        </a>
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

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Tanggal</th>
                                    <th>Wilayah</th>
                                    <th>Titik / Lokasi Layanan</th>
                                    <th>FO / Wireless</th>
                                    <th>Jenis Masalah</th>
                                    <th>Keterangan</th>
                                    <th>Penanganan</th>
                                    <th>Jumlah Kunjungan</th>
                                    <th>Status Masalah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->bulan }}</td>
                                    <td>{{ $row->tanggal }}</td>
                                    <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                                    <td>{{ $row->titik->nama_titik ?? '-' }}</td>
                                    <td>{{ $row->fo_wireless }}</td>
                                    <td>{{ $row->jenis_masalah->nama_masalah ?? '-' }}</td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                    <td>{{ $row->penanganan ?? '-' }}</td>
                                    <td>{{ $row->jumlah_kunjungan ?? 0 }}</td>
                                    <td>{{ $row->status_masalah }}</td>

                                    <td>
                                        <a href="{{ route('gangguan.edit', $row->id_gangguan) }}"
                                           class="btn btn-warning btn-sm mb-1">Edit</a>

                                        <form action="{{ route('gangguan.destroy', $row->id_gangguan) }}"
                                            method="POST"
                                            style="display:inline-block;">
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
                                    <td colspan="12" class="text-center py-4">
                                        <i class="nc-icon nc-zoom-split" style="font-size:48px; opacity:.3"></i>
                                        <p class="mb-0 mt-2">Tidak ada data</p>
                                    </td>
                                </tr>
                                @endforelse
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