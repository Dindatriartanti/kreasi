@extends('layouts.app')

@section('title', $title)

@section('content')

<section class="py-5 bg-light">

    <div class="container">

        <nav
            aria-label="breadcrumb"
            class="mb-4">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="{{ route('guest.home') }}">

                        Beranda

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="{{ route('guest.gallery') }}">

                        Gallery

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="{{ route('guest.gallery.museum.index') }}">

                        Museum

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    {{ $koleksi->nama_koleksi }}

                </li>

            </ol>

        </nav>


        <div class="row g-5 align-items-center">

            <div class="col-lg-7">

                <div class="museum-preview">

                    <img
                        src="{{ asset('storage/' . ($koleksi->gambar ?: 'system/defaultKoleksi.jpg')) }}"
                        class="img-fluid rounded-4 shadow"
                        alt="{{ $koleksi->nama_koleksi }}">

                </div>

            </div>


            <div class="col-lg-5">

                <span class="badge bg-primary mb-3">

                    {{ $koleksi->kategori->nama_kategori }}

                </span>

                <h1 class="fw-bold mb-3">

                    {{ $koleksi->nama_koleksi }}

                </h1>


                <div class="mb-4">

                    <div class="d-flex align-items-center mb-3">

                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>

                        <strong>Lokasi :</strong>

                        <span class="ms-2">

                            {{ $koleksi->lokasi ?: '-' }}

                        </span>

                    </div>


                    <div class="d-flex align-items-center">

                        <i class="bi bi-tag-fill me-2 text-primary"></i>

                        <strong>Status :</strong>

                        <span class="badge bg-success ms-2">

                            Dipamerkan

                        </span>

                    </div>

                </div>


                <a
                    href="{{ route('guest.gallery.museum.index') }}"
                    class="btn btn-outline-primary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali ke Museum

                </a>

            </div>

        </div>

    </div>

</section>


<section class="py-5">

    <div class="container">

        <div class="row g-5">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 p-lg-5">

                        <h3 class="fw-bold mb-4">

                            Tentang Koleksi

                        </h3>


                        <div
                            class="text-muted"
                            style="
                                line-height:2;
                                text-align:justify;
                                white-space:pre-line;
                            ">

                            {{ $koleksi->deskripsi }}

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">

                            Informasi Koleksi

                        </h4>


                        <div class="mb-4">

                            <small class="text-muted">

                                Nama Koleksi

                            </small>

                            <h6 class="fw-semibold">

                                {{ $koleksi->nama_koleksi }}

                            </h6>

                        </div>


                        <div class="mb-4">

                            <small class="text-muted">

                                Kategori

                            </small>

                            <h6>

                                {{ $koleksi->kategori->nama_kategori }}

                            </h6>

                        </div>


                        <div class="mb-4">

                            <small class="text-muted">

                                Lokasi

                            </small>

                            <h6>

                                {{ $koleksi->lokasi ?: '-' }}

                            </h6>

                        </div>


                        <div class="mb-4">

                            <small class="text-muted">

                                Status

                            </small>

                            <br>

                            <span class="badge bg-success">

                                Dipamerkan

                            </span>

                        </div>


                        <hr>


                        <a
                            href="{{ route('guest.gallery.museum.index') }}"
                            class="btn btn-primary w-100">

                            <i class="bi bi-grid"></i>

                            Semua Koleksi

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="pb-5">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">

                    Koleksi Lainnya

                </h2>

                <p class="text-muted mb-0">

                    Jelajahi koleksi museum lainnya yang mungkin menarik
                    untuk Anda.

                </p>

            </div>

        </div>


        <div class="row g-4">

            @forelse($related as $item)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="museum-card h-100">

                        <div class="museum-card-image">

                            <img
                                src="{{ asset('storage/' . ($item->gambar ?: 'system/defaultKoleksi.jpg')) }}"
                                alt="{{ $item->nama_koleksi }}">

                            <div class="museum-overlay">

                                <a
                                    href="{{ route('guest.gallery.museum.show', $item) }}"
                                    class="btn btn-light rounded-pill">

                                    <i class="bi bi-eye"></i>

                                    Lihat Detail

                                </a>

                            </div>

                        </div>


                        <div class="museum-card-body">

                            <span class="badge bg-primary mb-2">

                                {{ $item->kategori->nama_kategori }}

                            </span>


                            <h5 class="fw-bold">

                                {{ Str::limit($item->nama_koleksi, 45) }}

                            </h5>


                            <div class="d-flex align-items-center text-muted small mt-3">

                                <i class="bi bi-geo-alt me-2"></i>

                                {{ $item->lokasi ?: '-' }}

                            </div>

                        </div>


                        <div class="museum-card-footer">

                            <a
                                href="{{ route('guest.gallery.museum.show', $item) }}"
                                class="btn btn-primary w-100">

                                Selengkapnya

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-light border rounded-4">

                        Belum ada koleksi lainnya pada kategori ini.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection