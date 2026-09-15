@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- ========================================= --}}
    {{-- Header --}}
    {{-- ========================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">

                Kategori Kontributor

            </h4>

            <p class="text-muted mb-0">

                Kelola kategori kontributor berdasarkan kategori utama.

            </p>

        </div>

        <a
            href="{{ route('admin.kategori-kontributor.create') }}"
            class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Data

        </a>

    </div>

    {{-- ========================================= --}}
    {{-- Search --}}
    {{-- ========================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form
                method="GET"
                class="row g-3">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari kategori kontributor..."
                        value="{{ $search }}">

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- ========================================= --}}
    {{-- Table --}}
    {{-- ========================================= --}}

    <div class="card shadow-sm border-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">

                            No

                        </th>

                        <th>

                            Kategori

                        </th>

                        <th>

                            Kategori Kontributor

                        </th>

                        <th>

                            Jumlah Karya

                        </th>

                        <th>

                            Status

                        </th>

                        <th width="140">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kategoriKontributors as $item)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($kategoriKontributors->firstItem() - 1) }}

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $item->kategori->nama_kategori ?? '-' }}

                                </span>

                            </td>

                            <td>

                                <strong>

                                    {{ $item->nama_kategori }}

                                </strong>

                                @if($item->deskripsi)

                                    <br>

                                    <small class="text-muted">

                                        {{ Str::limit($item->deskripsi,60) }}

                                    </small>

                                @endif

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $item->karya_count }}

                                </span>

                            </td>

                            <td>

                                @if($item->status=='aktif')

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Nonaktif

                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.kategori-kontributor.edit',$item->id_kategori_kontributor) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <form
                                        action="{{ route('admin.kategori-kontributor.destroy',$item->id_kategori_kontributor) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>

                                    Belum ada data kategori kontributor.

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($kategoriKontributors->hasPages())

            <div class="card-footer bg-white">

                {{ $kategoriKontributors->links() }}

            </div>

        @endif

    </div>

</div>

@endsection