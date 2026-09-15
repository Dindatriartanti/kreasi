@extends('layouts.app')

@push('styles')
    @vite('resources/css/kegiatan.css')
@endpush

@section('content')

<section class="py-5">

    <div class="container">

        <div class="row g-5">

            {{-- Poster --}}
            <div class="col-lg-7">

                @if($kegiatan->poster)

                    <img
                        src="{{ asset('storage/' . $kegiatan->poster) }}"
                        alt="{{ $kegiatan->nama_kegiatan }}"
                        class="img-fluid rounded shadow w-100"
                        style="max-height: 550px; object-fit: cover;">

                @else

                    <div
                        class="d-flex align-items-center justify-content-center bg-light rounded"
                        style="height: 450px;">

                        <i class="bi bi-calendar-event display-1 text-muted"></i>

                    </div>

                @endif

            </div>


            {{-- Informasi Kegiatan --}}
            <div class="col-lg-5">

                <div class="event-date mb-3">

                    <i class="bi bi-calendar3 me-1"></i>

                    {{ $kegiatan->tanggal_mulai->translatedFormat('d F Y') }}

                </div>


                <h2 class="fw-bold">

                    {{ $kegiatan->nama_kegiatan }}

                </h2>


                {{-- Lokasi --}}
                <p class="location text-muted">

                    <i class="bi bi-geo-alt me-1"></i>

                    {{ $kegiatan->lokasi_kegiatan ?: 'Lokasi belum ditentukan' }}

                </p>


                {{-- Status --}}
                <div class="mb-4">

                    @if($kegiatan->status === 'publish')

                        <span class="badge bg-success">

                            Publikasi

                        </span>

                    @elseif($kegiatan->status === 'selesai')

                        <span class="badge bg-secondary">

                            Selesai

                        </span>

                    @endif


                    @if($kegiatan->is_booking === 'ya')

                        <span class="badge bg-primary">

                            Booking Dibuka

                        </span>

                    @endif

                </div>


                <hr>


                {{-- Deskripsi --}}
                <div class="mt-4">

                    <h5 class="fw-bold mb-3">

                        Tentang Kegiatan

                    </h5>

                    <p style="white-space: pre-line;">

                        {{ $kegiatan->deskripsi_kegiatan }}

                    </p>

                </div>


                {{-- Informasi Tambahan --}}
                <div class="mt-4">

                    <div class="row g-3">

                        <div class="col-6">

                            <div class="p-3 bg-light rounded">

                                <small class="text-muted d-block">
                                    Kuota
                                </small>

                                <strong>

                                    {{ $kegiatan->kuota }} Orang

                                </strong>

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="p-3 bg-light rounded">

                                <small class="text-muted d-block">
                                    Tanggal
                                </small>

                                <strong>

                                    {{ $kegiatan->tanggal_mulai->format('d M Y') }}

                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Booking --}}
                @if($kegiatan->is_booking === 'ya')

                    <a
                        href="{{ route('guest.kontak') }}"
                        class="btn btn-primary mt-4">

                        <i class="bi bi-calendar-check me-1"></i>

                        Daftar Kunjungan

                    </a>

                @endif


                {{-- Kembali --}}
                <div>

                    <a
                        href="{{ route('guest.kegiatan.index') }}"
                        class="btn btn-outline-secondary mt-3">

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali ke Kegiatan

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- Kegiatan Lainnya --}}
@if($related->count())

<section class="py-5 bg-light">

    <div class="container">

        <div class="mb-4">

            <span class="section-badge">
                Kegiatan
            </span>

            <h3 class="fw-bold mt-2">

                Kegiatan Lainnya

            </h3>

        </div>


        <div class="row g-4">

            @foreach($related as $item)

                <div class="col-lg-4 col-md-6">

                    <div class="card event-card h-100 border-0 shadow-sm overflow-hidden">


                        {{-- Poster --}}
                        @if($item->poster)

                            <img
                                src="{{ asset('storage/' . $item->poster) }}"
                                alt="{{ $item->nama_kegiatan }}"
                                class="card-img-top"
                                style="height:240px; object-fit:cover;">

                        @else

                            <div
                                class="d-flex align-items-center justify-content-center bg-light"
                                style="height:240px;">

                                <i class="bi bi-calendar-event display-4 text-muted"></i>

                            </div>

                        @endif


                        <div class="card-body d-flex flex-column">

                            {{-- Tanggal --}}
                            <div class="event-date mb-2">

                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $item->tanggal_mulai->translatedFormat('d M Y') }}

                            </div>


                            {{-- Nama --}}
                            <h5 class="fw-bold">

                                {{ $item->nama_kegiatan }}

                            </h5>


                            {{-- Lokasi --}}
                            <p class="text-muted small">

                                <i class="bi bi-geo-alt me-1"></i>

                                {{ $item->lokasi_kegiatan ?: 'Lokasi belum ditentukan' }}

                            </p>


                            <div class="mt-auto">

                                <a
                                    href="{{ route(
                                        'guest.kegiatan.show',
                                        $item
                                    ) }}"
                                    class="btn btn-sm btn-primary">

                                    Lihat Detail

                                    <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection