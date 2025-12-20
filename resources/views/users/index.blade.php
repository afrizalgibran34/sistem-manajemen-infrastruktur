@extends('layouts.app', [
    'activePage' => 'users',
    'title' => __('Manajemen User'),
    'navName' => 'User'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Manajemen User</h4>
                    <p class="card-category mb-0">Daftar user sistem</p>
                </div>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                    + Tambah User
                </a>
            </div>

            <div class="card-body table-responsive">              
                <table class="table table-striped align-middle text-center">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $i => $user)
                        <tr>
                            <td>
                                {{ method_exists($data, 'firstItem') 
                                    ? $data->firstItem() + $i 
                                    : $i + 1 }}
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                Tidak ada data user
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                @if(method_exists($data, 'links'))
                    <div class="mt-3">
                        {{ $data->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

