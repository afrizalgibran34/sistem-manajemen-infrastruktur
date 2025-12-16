@extends('layouts.app', [
    'activePage' => 'gangguan_index',
    'title' => __('Laporan Gangguan Jaringan'),
    'navName' => 'Gangguan',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0">Laporan Gangguan Jaringan</h4>
                            <p class="card-category mb-0">
                                Rekap semua gangguan berdasarkan titik layanan
                            </p>
                        </div>

                        <a href="{{ route('gangguan.exportPdf') }}" class="btn btn-danger btn-sm">
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
                                @foreach ($data as $index => $row)
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
                                            <button onclick="return confirm('Hapus data ini?')"
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
