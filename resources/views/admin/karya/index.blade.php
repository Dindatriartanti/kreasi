@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h5 class="mb-0">

                {{ $title }}

                <span class="badge bg-primary">

                    {{ $karya->total() }}

                </span>

            </h5>

        </div>

    </div>

    <div class="card-body border-bottom">

        <form method="GET">

            <div class="row g-2">

                <div class="col-lg-3">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul karya..."
                        value="{{ $search }}">

                </div>

                <div class="col-lg-3">

                    <select
                        name="kontributor"
                        class="form-select">

                        <option value="">

                            Semua Kontributor

                        </option>

                        @foreach($kontributors as $item)

                            <option
                                value="{{ $item->id_kontributor }}"
                                @selected($kontributor==$item->id_kontributor)>

                                {{ $item->nama_kontributor }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <select
                        name="kategori"
                        class="form-select">

                        <option value="">

                            Semua Kategori

                        </option>

                        @foreach($kategoriKontributors as $item)

                            <option
                                value="{{ $item->id_kategori_kontributor }}"
                                @selected($kategori==$item->id_kategori_kontributor)>

                                {{ $item->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="review"
                            @selected($status=='review')>

                            Review

                        </option>

                        <option
                            value="publish"
                            @selected($status=='publish')>

                            Publish

                        </option>

                        <option
                            value="ditolak"
                            @selected($status=='ditolak')>

                            Ditolak

                        </option>

                    </select>

                </div>

                <div class="col-lg-2 d-grid">

                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="70">

                            Thumbnail

                        </th>

                        <th>

                            Judul

                        </th>

                        <th>

                            Kontributor

                        </th>

                        <th>

                            Kategori

                        </th>

                        <th>

                            Status

                        </th>

                        <th>

                            Upload

                        </th>

                        <th width="150">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($karya as $item)

                        <tr>

                            <td>

                                <img
                                    src="{{ asset('storage/'.($item->thumbnail ?: 'system/noimage.jpg')) }}"
                                    class="rounded border"
                                    width="60"
                                    height="60"
                                    style="object-fit:cover;">

                            </td>

                            <td>

                                <strong>

                                    {{ $item->judul_karya }}

                                </strong>

                            </td>

                            <td>

                                {{ $item->kontributor->nama_kontributor }}

                            </td>

                            <td>

                                {{ $item->kategoriKontributor->nama_kategori }}

                            </td>

                            <td>

                                @if($item->status=='publish')

                                    <span class="badge bg-success">

                                        Publish

                                    </span>

                                @elseif($item->status=='review')

                                    <span class="badge bg-warning text-dark">

                                        Review

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Ditolak

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $item->tanggal_upload->format('d M Y') }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.karya.show',$item) }}"
                                    class="btn btn-info btn-sm">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a
                                    href="{{ route('admin.karya.edit',$item) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="{{ route('admin.karya.destroy',$item) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus karya ini?')"
                                        class="btn btn-danger btn-sm">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-images fs-1 text-secondary"></i>

                                <div>

                                    Belum ada data karya.

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($karya->hasPages())

        <div class="card-footer bg-white">

            {{ $karya->links() }}

        </div>

    @endif

</div>

@endsection