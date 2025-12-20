@extends('layouts.app', [
    'activePage' => 'jenis_masalah',
    'title' => __('Data Jenis Masalah'),
    'navName' => 'Jenis Masalah',
    'activeButton' => 'dataLaporan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- Tombol Tambah --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('jenis_masalah.create') }}" class="btn btn-primary">
                    + Tambah Jenis Masalah
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">

                <div class="card strpied-tabled-with-hover">

                    <div class="card-header">
                        <h4 class="card-title">Data Jenis Masalah</h4>
                        <p class="card-category">Daftar jenis masalah yang sering terjadi</p>
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

                        <table class="table table-hover table-striped text-center align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 60%;">Nama Masalah</th>
                                    <th style="width: 30%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td>{{ $row->id_jenismasalah }}</td>
                                    <td>{{ $row->nama_masalah }}</td>
                                    <td class="text-center">

                                        <a href="{{ route('jenis_masalah.edit', $row->id_jenismasalah) }}"
                                           class="btn btn-warning btn-sm mr-2">
                                            Edit
                                        </a>

                                        <form action="{{ route('jenis_masalah.destroy', $row->id_jenismasalah) }}"
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
