@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">{{ $title }}</h4>

            <small class="text-muted">

                Kelola seluruh data kegiatan.

            </small>

        </div>

        <a href="{{ route('admin.kegiatan.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Kegiatan

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <form method="GET"
                  action="{{ route('admin.kegiatan.index') }}">

                <div class="row">

                    <div class="col-md-4">

                        <div class="input-group">

                            <input
                                type="text"
                                class="form-control"
                                name="search"
                                placeholder="Cari kegiatan..."
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

                            <th width="90">Poster</th>

                            <th>Nama Kegiatan</th>

                            <th>Kategori</th>

                            <th>Tanggal</th>

                            <th>Kuota</th>

                            <th>Booking</th>

                            <th>Status</th>

                            <th width="150" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($kegiatan as $item)

                        <tr>

                            <td>

                                {{ $kegiatan->firstItem() + $loop->index }}

                            </td>

                            <td>

                                @if($item->poster)

                                    <img
                                        src="{{ asset('storage/'.$item->poster) }}"
                                        width="65"
                                        height="65"
                                        class="rounded border object-fit-cover">

                                @else

                                    <div
                                        class="rounded border d-flex align-items-center justify-content-center bg-light"
                                        style="width:65px;height:65px;">

                                        <i class="bi bi-image"></i>

                                    </div>

                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $item->nama_kegiatan }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $item->lokasi_kegiatan }}

                                </small>

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $item->kategori->nama_kategori }}

                                </span>

                            </td>

                            <td>

                                <small>

                                    {{ $item->tanggal_mulai->format('d M Y') }}

                                    <br>

                                    s/d

                                    <br>

                                    {{ $item->tanggal_selesai->format('d M Y') }}

                                </small>

                            </td>

                            <td>

                                {{ $item->kuota }}

                            </td>

                            <td>

                                @if($item->is_booking=='ya')

                                    <span class="badge bg-success">

                                        Dibuka

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Ditutup

                                    </span>

                                @endif

                            </td>

                            <td>

                                @switch($item->status)

                                    @case('draft')

                                        <span class="badge bg-warning text-dark">

                                            Draft

                                        </span>

                                    @break

                                    @case('publish')

                                        <span class="badge bg-success">

                                            Publish

                                        </span>

                                    @break

                                    @case('selesai')

                                        <span class="badge bg-primary">

                                            Selesai

                                        </span>

                                    @break

                                @endswitch

                            </td>

                            <td class="text-center">

                                <a
                                    href="{{ route('admin.kegiatan.edit', $item) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form
                                    action="{{ route('admin.kegiatan.destroy', $item) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus kegiatan ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-5">

                                <i class="bi bi-calendar-x display-6 d-block mb-2"></i>

                                Belum ada data kegiatan.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $kegiatan->links() }}

        </div>

    </div>

</div>

@endsection