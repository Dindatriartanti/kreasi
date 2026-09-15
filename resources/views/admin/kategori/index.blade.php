@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">{{ $title }}</h4>

            <small class="text-muted">
                Kelola data kategori pada sistem.
            </small>

        </div>

        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Kategori

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <form action="{{ route('admin.kategori.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <div class="input-group">

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari kategori..."
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

                            <th>Nama Kategori</th>

                            <th>Slug</th>

                            <th>Icon</th>

                            <th>Status</th>

                            <th width="180" class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($kategori as $item)

                        <tr>

                            <td>

                                {{ $kategori->firstItem() + $loop->index }}

                            </td>

                            <td>

                                <strong>{{ $item->nama_kategori }}</strong>

                            </td>

                            <td>

                                <code>{{ $item->slug }}</code>

                            </td>

                            <td>

                                {{ $item->icon ?? '-' }}

                            </td>

                            <td>

                                @if($item->status == 'aktif')

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

                                <a href="{{ route('admin.kategori.edit', $item->id_kategori) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('admin.kategori.destroy', $item->id_kategori) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-4">

                                Tidak ada data kategori.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $kategori->links() }}

        </div>

    </div>

</div>

@endsection