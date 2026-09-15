@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                Sedang Diajukan

            </h5>

            <a
                href="{{ route('kontributor.karya.create') }}"
                class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>

                Upload Karya

            </a>

        </div>

        <div class="card-body">

            <div class="alert alert-warning">

                <i class="bi bi-hourglass-split me-2"></i>

                Karya pada halaman ini sedang menunggu proses review oleh admin.
                Anda masih dapat mengubah atau menghapus karya sebelum dipublikasikan.

            </div>

            <div class="row">

                @forelse($karya as $item)

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <div class="card border-0 shadow-sm h-100">

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

                                    <span class="badge bg-warning text-dark">

                                        Review

                                    </span>

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
                                            onclick="return confirm('Yakin ingin menghapus karya ini?')"
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

                            <i class="bi bi-hourglass-split display-3 text-secondary"></i>

                            <h4 class="mt-3">

                                Tidak ada karya yang sedang diajukan.

                            </h4>

                            <a
                                href="{{ route('kontributor.karya.create') }}"
                                class="btn btn-primary mt-3">

                                Upload Karya

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