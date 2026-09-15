@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">{{ $title }}</h4>

            <small class="text-muted">
                Kelola seluruh data user pada sistem.
            </small>

        </div>

        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah User

        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif

    {{-- Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <form action="{{ route('admin.user.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari nama, username atau email..."
                                value="{{ request('search') }}">

                            <button class="btn btn-primary">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Nama</th>

                            <th>Username</th>

                            <th>Email</th>

                            <th>No HP</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th width="150" class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>

                                {{ $users->firstItem() + $loop->index }}

                            </td>

                            <td>

                                {{ $user->name }}

                            </td>

                            <td>

                                {{ $user->username }}

                            </td>

                            <td>

                                {{ $user->email }}

                            </td>

                            <td>

                                {{ $user->no_hp ?? '-' }}

                            </td>

                            <td>

                                @if($user->role == 'admin')

                                    <span class="badge bg-primary">

                                        Admin

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        Kontributor

                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($user->status == 'aktif')

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Nonaktif

                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <a href="{{ route('admin.user.edit',$user->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('admin.user.destroy',$user->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="text-center py-4">

                                Tidak ada data.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $users->links() }}

        </div>

    </div>

</div>

@endsection