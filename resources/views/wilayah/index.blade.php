@extends('layouts.app', [
    'activePage' => 'wilayah',
    'title' => __('Data Wilayah'),
    'navName' => 'Wilayah',
    'activeButton' => 'dataJaringan'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- TOMBOL TAMBAH --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('wilayah.create') }}" class="btn btn-primary">
                    + Tambah Wilayah
                </a>
            </div>
        </div>

        {{-- TABLE WILAYAH --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    
                    <div class="card-header">
                        <h4 class="card-title">Data Wilayah</h4>
                        <p class="card-category">Daftar seluruh wilayah yang tersedia</p>
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
            <th width="80">ID</th>
            <th class="text-center">Nama Wilayah</th>
            <th width="180">Aksi</th>
        </thead>

        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->id_wilayah }}</td>
                <td>{{ $row->nama_wilayah }}</td>
                <td>
                    <div class="d-flex justify-content-center gap-2">

                        <a href="{{ route('wilayah.edit', $row->id_wilayah) }}" 
                           class="btn btn-warning btn-sm mr-3">
                            Edit
                        </a>

                       <form action="{{ route('wilayah.destroy', $row->id_wilayah) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="btn btn-danger btn-sm btn-delete">
                                Hapus
                            </button>
                        </form>


                    </div>
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

<script>
function changeEntries(perPage) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    url.searchParams.delete('page'); // Reset to page 1
    window.location.href = url.toString();
}
</script>
@endsection
