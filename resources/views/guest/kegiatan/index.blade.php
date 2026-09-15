@extends('layouts.app')

@push('styles')
    @vite('resources/css/kegiatan.css')
@endpush

@section('content')

{{-- Header --}}
<section class="py-5 bg-light">

    <div class="container">

        <h1 class="fw-bold">
            Kegiatan
        </h1>

        <p class="text-muted mb-0">

            Informasi kegiatan, pameran, workshop, pelatihan,
            dan berbagai aktivitas Ruang Kreasi Kabupaten Cirebon.

        </p>

    </div>

</section>


{{-- Daftar Kegiatan --}}
<section class="py-5">

    <div class="container">

        {{-- Search --}}
        <form
            method="GET"
            class="row mb-5">

            <div class="col-md-10">

                <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="Cari kegiatan..."
                    value="{{ $search }}">

            </div>

            <div class="col-md-2 d-grid">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-search me-1"></i>

                    Cari

                </button>

            </div>

        </form>


        {{-- Cards --}}
        <div class="row g-4">

            @forelse($kegiatan as $item)

                <div class="col-lg-4 col-md-6">

                    <div class="card event-card h-100 border-0 shadow-sm overflow-hidden">


                        {{-- Poster --}}
                        @if($item->poster)

                            <img
                                src="{{ asset('storage/' . $item->poster) }}"
                                alt="{{ $item->nama_kegiatan }}"
                                class="card-img-top event-image">

                        @else

                            <div
                                class="event-image-placeholder">

                                <i class="bi bi-calendar-event"></i>

                            </div>

                        @endif


                        {{-- Content --}}
                        <div class="card-body d-flex flex-column">


                            {{-- Tanggal --}}

                            <div class="event-date mb-2">

                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $item->tanggal_mulai->translatedFormat('d M Y') }}

                            </div>


                            {{-- Nama --}}

                            <h4 class="fw-bold">

                                {{ $item->nama_kegiatan }}

                            </h4>


                            {{-- Lokasi --}}

                            <p class="location text-muted">

                                <i class="bi bi-geo-alt me-1"></i>

                                {{ $item->lokasi_kegiatan ?: 'Lokasi belum ditentukan' }}

                            </p>


                            {{-- Deskripsi --}}

                            <p class="text-muted">

                                {{ Str::limit(
                                    strip_tags($item->deskripsi_kegiatan),
                                    120
                                ) }}

                            </p>


                            {{-- Status --}}

                            <div class="mb-3">

                                @if($item->status === 'publish')

                                    <span class="badge bg-success">

                                        Publikasi

                                    </span>

                                @elseif($item->status === 'selesai')

                                    <span class="badge bg-secondary">

                                        Selesai

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">

                                        Draft

                                    </span>

                                @endif


                                @if($item->is_booking === 'ya')

                                    <span class="badge bg-primary">

                                        Booking Dibuka

                                    </span>

                                @endif

                            </div>


                            {{-- Button --}}

                            <div class="mt-auto">

                                <a
                                    href="{{ route(
                                        'guest.kegiatan.show',
                                        $item
                                    ) }}"
                                    class="btn btn-outline-primary">

                                    Lihat Detail

                                    <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-light border text-center py-5">

                        <i class="bi bi-calendar-x display-5 text-muted"></i>

                        <h5 class="mt-3">

                            Belum ada kegiatan.

                        </h5>

                        <p class="text-muted mb-0">

                            Kegiatan yang telah dipublikasikan
                            akan ditampilkan di sini.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}

        <div class="mt-5">

            {{ $kegiatan->links() }}

        </div>

    </div>

</section>

@endsection