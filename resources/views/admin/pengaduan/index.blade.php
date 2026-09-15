@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">{{ $title }}</h4>
            <small class="text-muted">
                Kelola data pengaduan pengunjung.
            </small>
        </div>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <form method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama, email atau subjek..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-auto">

                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

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
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="120">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pengaduan as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($pengaduan->firstItem() - 1) }}
                            </td>

                            <td>{{ $item->name }}</td>

                            <td>{{ $item->email }}</td>

                            <td>{{ $item->subject }}</td>

                            <td>

                                @if($item->is_read)

                                    <span class="badge bg-success">
                                        Sudah Dibaca
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Belum Dibaca
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $item->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.pengaduan.edit',$item) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="{{ route('admin.pengaduan.destroy',$item) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-4">

                                Tidak ada data pengaduan.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $pengaduan->links() }}

        </div>

    </div>

</div>

@endsection