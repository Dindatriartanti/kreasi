@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    Galeri Karya Saya

                </h5>

                <a
                    href="{{ route('kontributor.karya.create') }}"
                    class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>

                    Upload Karya

                </a>

            </div>

        </div>

        <div class="card-body">

            <form
                method="GET"
                class="row g-3 mb-4">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul karya..."
                        value="{{ $search }}">

                </div>

                <div class="col-md-3">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">

                            Semua Status

                        </option>

                        <option
                            value="publish"
                            @selected($status=='publish')>

                            Publish

                        </option>

                        <option
                            value="review"
                            @selected($status=='review')>

                            Review

                        </option>

                        <option
                            value="ditolak"
                            @selected($status=='ditolak')>

                            Ditolak

                        </option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-primary w-100">

                        Cari

                    </button>

                </div>

                <div class="col-md-2">

                    <a
                        href="{{ route('kontributor.karya.index') }}"
                        class="btn btn-outline-secondary w-100">

                        Reset

                    </a>

                </div>

            </form>

            <div class="row">

                @forelse($karya as $item)

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card h-100 shadow-sm border-0">

                            <img
                                src="{{ asset('storage/' . ($item->thumbnail ?: 'system/noimage.jpg')) }}"
                                class="card-img-top"
                                style="height:220px;object-fit:cover;">

                            <div class="card-body">

                                <h6 class="fw-bold">

                                    {{ Str::limit($item->judul_karya,35) }}

                                </h6>

                                <small class="text-muted">

                                    {{ $item->kategoriKontributor->nama_kategori }}

                                </small>

                                <div class="mt-3">

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

                                </div>

                            </div>

                            <div class="card-footer bg-white">

                                <div class="d-grid gap-2">

                                    <a
                                        href="{{ route('kontributor.karya.show',$item) }}"
                                        class="btn btn-outline-primary btn-sm">

                                        Detail

                                    </a>

                                    <a
                                        href="{{ route('kontributor.karya.edit',$item) }}"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('kontributor.karya.destroy',$item) }}"
                                        method="POST">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Hapus karya ini?')"
                                            class="btn btn-danger btn-sm w-100">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="text-center py-5">

                            <i class="bi bi-images display-3 text-secondary"></i>

                            <h4 class="mt-3">

                                Belum ada karya

                            </h4>

                            <a
                                href="{{ route('kontributor.karya.create') }}"
                                class="btn btn-primary mt-3">

                                Upload Karya Pertama

                            </a>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

        @if($karya->hasPages())

            <div class="card-footer bg-white">

                {{ $karya->links() }}

            </div>

        @endif

    </div>

</div>

@endsection