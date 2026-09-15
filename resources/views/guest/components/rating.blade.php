<section class="rating-section mt-5">

    <div class="container">

        <div class="rating-header mb-4">

            <div>
                <span class="rating-badge">
                    Penilaian
                </span>

                <h2 class="rating-title mt-2">
                    Rating & Komentar
                </h2>

                <p class="text-muted mb-0">
                    Berikan penilaian dan komentar Anda
                    terhadap kontributor ini.
                </p>
            </div>

        </div>


        {{-- RINGKASAN RATING --}}
        <div class="rating-summary-card mb-4">

            <div class="row align-items-center">

                <div class="col-md-4 text-center">

                    <div class="rating-average">

                        {{ $ratingRataRata
                            ? number_format($ratingRataRata, 1)
                            : '0.0'
                        }}

                    </div>

                    <div class="rating-stars">

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

                    <div class="text-muted mt-2">

                        {{ $jumlahRating }}

                        {{ $jumlahRating == 1
                            ? 'penilaian'
                            : 'penilaian'
                        }}

                    </div>

                </div>


                <div class="col-md-8">

                    <div class="rating-info">

                        <i class="bi bi-star-fill"></i>

                        <div>
                            <strong>
                                Bagaimana pengalaman Anda?
                            </strong>

                            <p class="mb-0 text-muted">
                                Berikan rating dan komentar
                                untuk membantu pengguna lain.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FORM RATING --}}
        @auth

            <div class="rating-form-card mb-5">

                <h5 class="mb-3">
                    Berikan Rating
                </h5>

                <form
                    action="{{ route(
                        'guest.gallery.kontributor.rating.store',
                        $kontributor->slug
                    ) }}"
                    method="POST"
                >

                    @csrf


                    <div class="mb-4">

                        <label class="form-label">
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
                                >

                                <label
                                    for="rating{{ $i }}"
                                    title="{{ $i }} bintang"
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


                    <div class="mb-3">

                        <label
                            for="komentar"
                            class="form-label"
                        >
                            Komentar
                        </label>

                        <textarea
                            name="komentar"
                            id="komentar"
                            rows="4"
                            class="form-control @error('komentar') is-invalid @enderror"
                            placeholder="Tulis pengalaman atau pendapat Anda..."
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

        @else

            <div class="login-rating-card mb-5">

                <div class="text-center">

                    <i class="bi bi-person-circle fs-1"></i>

                    <h5 class="mt-3">
                        Ingin memberikan rating?
                    </h5>

                    <p class="text-muted">
                        Silakan login terlebih dahulu
                        untuk memberikan rating dan komentar.
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary rounded-pill px-4"
                    >
                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Login
                    </a>

                </div>

            </div>

        @endauth


        {{-- DAFTAR KOMENTAR --}}
        <div class="rating-comments">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="mb-0">
                    Komentar Pengguna
                </h4>

                <span class="text-muted">
                    {{ $jumlahRating }} penilaian
                </span>

            </div>


            @forelse($rating as $item)

                <div class="comment-card mb-3">

                    <div class="d-flex gap-3">

                        <div class="comment-avatar">

                            {{ strtoupper(
                                substr(
                                    $item->user->name ?? 'U',
                                    0,
                                    1
                                )
                            ) }}

                        </div>


                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <h6 class="mb-1">

                                        {{ $item->user->name ?? 'Pengguna' }}

                                    </h6>


                                    <div class="comment-stars">

                                        @for($i = 1; $i <= 5; $i++)

                                            @if($i <= $item->rating)

                                                <i class="bi bi-star-fill"></i>

                                            @else

                                                <i class="bi bi-star"></i>

                                            @endif

                                        @endfor

                                    </div>

                                </div>


                                <small class="text-muted">

                                    {{ $item->created_at
                                        ? $item->created_at->format('d M Y')
                                        : ''
                                    }}

                                </small>

                            </div>


                            @if($item->komentar)

                                <p class="mb-0 mt-2">

                                    {{ $item->komentar }}

                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-rating">

                    <i class="bi bi-chat-square-text"></i>

                    <h5>
                        Belum ada komentar
                    </h5>

                    <p class="text-muted mb-0">
                        Jadilah orang pertama yang memberikan
                        rating untuk kontributor ini.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>