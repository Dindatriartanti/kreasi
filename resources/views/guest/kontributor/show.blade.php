@extends('layouts.app')

@push('styles')
    @vite('resources/css/guest/rating.css')
@endpush

@section('title', $title)

@section('content')

{{-- =========================================================
     HERO / PROFILE KONTRIBUTOR
========================================================= --}}

<section>

    <div class="position-relative">

        <img
            src="{{ asset('storage/' . ($kontributor->foto_banner ?: 'system/defaultBanner.jpg')) }}"
            class="w-100"
            style="height:380px;object-fit:cover;"
            alt="Banner {{ $kontributor->nama_kontributor }}"
        >

        <div
            class="position-absolute top-50 start-50 translate-middle text-center text-white"
        >

            <img
                src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                class="rounded-circle border border-4 border-white shadow"
                width="170"
                height="170"
                style="object-fit:cover;"
                alt="{{ $kontributor->nama_kontributor }}"
            >

            <h2 class="fw-bold mt-3">
                {{ $kontributor->nama_kontributor }}
            </h2>

            <span class="badge bg-primary">

                {{ $kontributor->karya_publish_count }}

                Karya

            </span>

        </div>

    </div>

</section>


{{-- =========================================================
     INFORMASI KONTRIBUTOR
========================================================= --}}

<section class="py-5">

    <div class="container">

        <div class="row">

            {{-- DESKRIPSI --}}
            <div class="col-lg-8">

                <h4 class="fw-bold mb-3">
                    Tentang Kontributor
                </h4>

                <p class="text-muted">

                    {{ $kontributor->deskripsi }}

                </p>

            </div>


            {{-- INFORMASI --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Informasi
                        </h5>

                        <table class="table table-borderless">

                            <tr>

                                <th width="90">
                                    Alamat
                                </th>

                                <td>
                                    {{ $kontributor->alamat ?: '-' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Email
                                </th>

                                <td>
                                    {{ $kontributor->email ?: '-' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Website
                                </th>

                                <td>

                                    @if($kontributor->website)

                                        <a
                                            href="{{ $kontributor->website }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >
                                            {{ $kontributor->website }}
                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                            </tr>

                        </table>


                        {{-- SOSIAL MEDIA --}}
                        <div class="mt-4">

                            @if($kontributor->instagram)

                                <a
                                    href="{{ $kontributor->instagram }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-danger btn-sm"
                                >

                                    <i class="bi bi-instagram"></i>

                                </a>

                            @endif


                            @if($kontributor->facebook)

                                <a
                                    href="{{ $kontributor->facebook }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-primary btn-sm"
                                >

                                    <i class="bi bi-facebook"></i>

                                </a>

                            @endif


                            @if($kontributor->youtube)

                                <a
                                    href="{{ $kontributor->youtube }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-danger btn-sm"
                                >

                                    <i class="bi bi-youtube"></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     RINGKASAN RATING
========================================================= --}}

<section class="py-5 bg-light">

    <div class="container">

        <div class="row align-items-center">

            {{-- NILAI RATING --}}
            <div class="col-lg-4">

                <div class="rating-summary-card text-center">

                    <div class="rating-average">

                        {{
                            $ratingRataRata
                                ? number_format(
                                    $ratingRataRata,
                                    1
                                )
                                : '0.0'
                        }}

                    </div>


                    <div class="rating-stars mt-2">

                        @for($i = 1; $i <= 5; $i++)

                            @if(
                                $ratingRataRata &&
                                $i <= round($ratingRataRata)
                            )

                                <i class="bi bi-star-fill"></i>

                            @else

                                <i class="bi bi-star"></i>

                            @endif

                        @endfor

                    </div>


                    <p class="text-muted mb-0 mt-2">

                        {{ $jumlahRating }}

                        penilaian

                    </p>

                </div>

            </div>


            {{-- PENJELASAN --}}
            <div class="col-lg-8 mt-4 mt-lg-0">

                <span class="rating-badge">
                    Rating Kontributor
                </span>

                <h3 class="fw-bold mt-2">
                    Penilaian Pengguna
                </h3>

                <p class="text-muted mb-0">

                    Lihat penilaian dan komentar dari pengguna
                    yang telah melihat karya kontributor ini.

                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     KARYA KONTRIBUTOR
========================================================= --}}

<section class="pb-5">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">
                Karya Kontributor
            </h3>

            <span class="text-muted">

                {{ $karya->total() }}

                Karya Dipublikasikan

            </span>

        </div>


        <div class="row">

            @forelse($karya as $item)

                <div class="col-lg-3 col-md-4 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <img
                            src="{{ asset('storage/' . ($item->thumbnail ?: 'system/noimage.jpg')) }}"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;"
                            alt="{{ $item->judul_karya }}"
                        >


                        <div class="card-body">

                            <h6 class="fw-bold">

                                {{ Str::limit(
                                    $item->judul_karya,
                                    40
                                ) }}

                            </h6>

                        </div>


                        <div class="card-footer bg-white border-0">

                            <a
                                href="{{ route(
                                    'guest.gallery.kontributor.karya.show',
                                    [
                                        $kontributor,
                                        $item
                                    ]
                                ) }}"
                                class="btn btn-primary w-100"
                            >

                                Detail Karya

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i
                            class="bi bi-images display-1 text-secondary"
                        ></i>

                        <h4 class="mt-4">

                            Belum ada karya dipublikasikan.

                        </h4>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        <div class="mt-4">

            {{ $karya->links() }}

        </div>

    </div>

</section>


{{-- =========================================================
     FORM RATING
========================================================= --}}

<section class="py-5 bg-light">

    <div class="container">

        <div class="row">

            <div class="col-lg-8 mx-auto">

                <div class="rating-form-card">

                    <div class="text-center mb-4">

                        <span class="rating-badge">
                            Berikan Penilaian
                        </span>

                        <h3 class="fw-bold mt-2">
                            Bagaimana menurut Anda?
                        </h3>

                        <p class="text-muted mb-0">
                            Berikan rating dan komentar
                            untuk kontributor ini.
                        </p>

                    </div>


                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="alert alert-success">

                            <i class="bi bi-check-circle me-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if(session('error'))

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-circle me-2"></i>

                            {{ session('error') }}

                        </div>

                    @endif


                    {{-- VALIDATION ERROR --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-triangle me-2"></i>

                            <strong>
                                Terdapat kesalahan:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- FORM RATING --}}
                    {{-- TIDAK MENGGUNAKAN @auth --}}
                    <form
                        action="{{ route(
                            'guest.gallery.kontributor.rating.store',
                            $kontributor->slug
                        ) }}"
                        method="POST"
                    >

                        @csrf


                        {{-- RATING --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Rating

                            </label>


                            <div class="rating-input">

                                @for($i = 5; $i >= 1; $i--)

                                    <input
                                        type="radio"
                                        name="rating"
                                        value="{{ $i }}"
                                        id="rating{{ $i }}"
                                        {{ old('rating') == $i
                                            ? 'checked'
                                            : ''
                                        }}
                                        required
                                    >

                                    <label
                                        for="rating{{ $i }}"
                                        title="{{ $i }} Bintang"
                                    >

                                        <i class="bi bi-star-fill"></i>

                                    </label>

                                @endfor

                            </div>


                            @error('rating')

                                <div class="text-danger small mt-2">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- KOMENTAR --}}
                        <div class="mb-4">

                            <label
                                for="komentar"
                                class="form-label fw-semibold"
                            >

                                Komentar

                            </label>

                            <textarea
                                name="komentar"
                                id="komentar"
                                rows="5"
                                class="form-control @error('komentar') is-invalid @enderror"
                                placeholder="Tuliskan pendapat Anda mengenai kontributor ini..."
                            >{{ old('komentar') }}</textarea>


                            @error('komentar')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary rounded-pill px-4"
                        >

                            <i class="bi bi-send me-2"></i>

                            Kirim Rating

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     DAFTAR KOMENTAR
========================================================= --}}

<section class="py-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-9 mx-auto">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <span class="rating-badge">
                            Ulasan
                        </span>

                        <h3 class="fw-bold mt-2 mb-0">
                            Komentar Pengguna
                        </h3>

                    </div>


                    <span class="text-muted">

                        {{ $jumlahRating }}

                        penilaian

                    </span>

                </div>


                @forelse($rating as $item)

                    <div class="comment-card mb-3">

                        <div class="d-flex gap-3">

                            {{-- AVATAR --}}
                            <div class="comment-avatar">

                                {{
                                    strtoupper(
                                        substr(
                                            $item->user?->name ?? 'P',
                                            0,
                                            1
                                        )
                                    )
                                }}

                            </div>


                            {{-- ISI --}}
                            <div class="flex-grow-1">

                                <div
                                    class="d-flex justify-content-between align-items-start"
                                >

                                    <div>

                                        <h6 class="fw-bold mb-1">

                                            {{ $item->user?->name ?? 'Pengunjung' }}

                                        </h6>


                                        <div class="comment-stars">

                                            @for($i = 1; $i <= 5; $i++)

                                                @if(
                                                    $i <= $item->rating
                                                )

                                                    <i
                                                        class="bi bi-star-fill"
                                                    ></i>

                                                @else

                                                    <i
                                                        class="bi bi-star"
                                                    ></i>

                                                @endif

                                            @endfor

                                        </div>

                                    </div>


                                    <small class="text-muted">

                                        {{
                                            $item->created_at
                                                ? $item->created_at
                                                    ->format('d M Y')
                                                : ''
                                        }}

                                    </small>

                                </div>


                                @if($item->komentar)

                                    <p class="mt-3 mb-0">

                                        {{ $item->komentar }}

                                    </p>

                                @else

                                    <small class="text-muted mt-2 d-block">

                                        Pengunjung memberikan rating
                                        tanpa komentar.

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-rating text-center">

                        <i class="bi bi-chat-square-text"></i>

                        <h5 class="mt-3">

                            Belum ada komentar

                        </h5>

                        <p class="text-muted mb-0">

                            Belum ada pengguna yang memberikan
                            rating untuk kontributor ini.

                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</section>

@endsection