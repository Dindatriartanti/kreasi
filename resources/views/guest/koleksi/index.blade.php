@extends('layouts.app')

@section('title', $title)

@section('content')

{{-- ========================================================= --}}
{{-- Hero --}}
{{-- ========================================================= --}}

<section class="museum-hero">

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

                <li class="breadcrumb-item active">

                    Museum

                </li>

            </ol>

        </nav>

        <div class="row align-items-center">

            <div class="col-lg-7">

                <span class="badge bg-primary px-3 py-2 mb-3">

                    Gallery Museum

                </span>

                <h1 class="display-5 fw-bold">

                    Jelajahi Koleksi Museum Kabupaten Cirebon

                </h1>

                <p class="lead text-muted mt-3">

                    Temukan berbagai koleksi bersejarah yang menjadi bagian
                    dari warisan budaya Kabupaten Cirebon.

                </p>

            </div>

            <div class="col-lg-5">

                <div class="museum-counter">

                    <h2>

                        {{ $koleksi->total() }}

                    </h2>

                    <p>

                        Koleksi Dipamerkan

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- Search --}}
{{-- ========================================================= --}}

<section class="py-5">

    <div class="container">

        <form
            method="GET"
            action="{{ route('guest.gallery.museum.index') }}">

            <div class="row g-3">

                <div class="col-lg-7">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control form-control-lg"
                        placeholder="Cari nama koleksi...">

                </div>

                <div class="col-lg-3">

                    <select
                        name="kategori"
                        class="form-select form-select-lg">

                        <option value="">

                            Semua Kategori

                        </option>

                        @foreach($kategori as $item)

                            <option
                                value="{{ $item->id_kategori }}"
                                {{ $kategoriAktif == $item->id_kategori ? 'selected' : '' }}>

                                {{ $item->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2 d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary btn-lg">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>


{{-- ========================================================= --}}
{{-- Grid Koleksi --}}
{{-- ========================================================= --}}

<section class="pb-5">

    <div class="container">

        <div class="row g-4">

            @forelse($koleksi as $item)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <div class="museum-card h-100">

                        {{-- Thumbnail --}}

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


                        {{-- Content --}}

                        <div class="museum-card-body">

                            <span class="badge bg-primary mb-2">

                                {{ $item->kategori->nama_kategori }}

                            </span>

                            <h5 class="fw-bold mb-3">

                                {{ Str::limit($item->nama_koleksi, 50) }}

                            </h5>

                            <div class="d-flex align-items-center text-muted small mb-3">

                                <i class="bi bi-geo-alt me-2"></i>

                                {{ $item->lokasi ?: 'Museum Kabupaten Cirebon' }}

                            </div>

                            <p class="text-muted">

                                {{ Str::limit(strip_tags($item->deskripsi), 100) }}

                            </p>

                        </div>


                        {{-- Footer --}}

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

                    <div class="text-center py-5">

                        <img
                            src="{{ asset('images/empty.svg') }}"
                            width="220"
                            class="mb-4">

                        <h3 class="fw-bold">

                            Koleksi Tidak Ditemukan

                        </h3>

                        <p class="text-muted">

                            Maaf, koleksi yang Anda cari belum tersedia
                            atau belum dipublikasikan.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}

        @if($koleksi->hasPages())

            <div class="row mt-5">

                <div class="col-12 d-flex justify-content-center">

                    {{ $koleksi->links() }}

                </div>

            </div>

        @endif

    </div>

</section>


{{-- ========================================================= --}}
{{-- CTA --}}
{{-- ========================================================= --}}

<section class="py-5 bg-light">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8 text-center">

                <h2 class="fw-bold mb-3">

                    Jelajahi Lebih Banyak Warisan Budaya

                </h2>

                <p class="text-muted mb-4">

                    Masih banyak koleksi bersejarah lainnya yang dapat Anda
                    eksplorasi di Museum Kabupaten Cirebon maupun Gallery
                    Kontributor Ruang Kreasi.

                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">

                    <a
                        href="{{ route('guest.gallery') }}"
                        class="btn btn-outline-primary px-4">

                        <i class="bi bi-grid"></i>

                        Kembali ke Gallery

                    </a>

                    <a
                        href="{{ route('guest.gallery.kontributor.index') }}"
                        class="btn btn-primary px-4">

                        <i class="bi bi-palette"></i>

                        Gallery Kontributor

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection