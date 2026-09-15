@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Rating & Komentar
            </h3>

            <p class="text-muted mb-0">
                Lihat penilaian dan komentar yang diberikan
                pengguna terhadap profil Anda.
            </p>
        </div>

    </div>


    {{-- STATISTIK --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-warning bg-opacity-10 p-3"
                        >
                            <i class="bi bi-star-fill text-warning fs-4"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Rating Rata-rata
                            </small>

                            <h3 class="fw-bold mb-0">

                                {{ $ratingRataRata
                                    ? number_format(
                                        $ratingRataRata,
                                        1
                                    )
                                    : '0.0'
                                }}

                                <small class="text-muted">
                                    / 5
                                </small>

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-primary bg-opacity-10 p-3"
                        >
                            <i class="bi bi-star text-primary fs-4"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Jumlah Penilaian
                            </small>

                            <h3 class="fw-bold mb-0">
                                {{ $jumlahRating }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-success bg-opacity-10 p-3"
                        >
                            <i class="bi bi-chat-left-text text-success fs-4"></i>
                        </div>

                        <div>

                            <small class="text-muted">
                                Komentar
                            </small>

                            <h3 class="fw-bold mb-0">

                                {{
                                    $kontributor->rating()
                                        ->where('status', 'tampil')
                                        ->whereNotNull('komentar')
                                        ->where(
                                            'komentar',
                                            '!=',
                                            ''
                                        )
                                        ->count()
                                }}

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DAFTAR RATING --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">
                Penilaian Pengguna
            </h5>

        </div>


        <div class="card-body">

            @forelse($rating as $item)

                <div class="rating-item">

                    <div class="d-flex gap-3">

                        <div class="rating-avatar">

                            {{
                                strtoupper(
                                    substr(
                                        $item->user->name ?? 'U',
                                        0,
                                        1
                                    )
                                )
                            }}

                        </div>


                        <div class="flex-grow-1">

                            <div
                                class="d-flex justify-content-between"
                            >

                                <div>

                                    <h6 class="fw-bold mb-1">

                                        {{
                                            $item->user->name
                                            ?? 'Pengguna'
                                        }}

                                    </h6>


                                    <div class="text-warning">

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
                                                ->format('d M Y H:i')
                                            : ''
                                    }}

                                </small>

                            </div>


                            @if($item->komentar)

                                <div class="mt-3">

                                    <p class="mb-0">
                                        {{ $item->komentar }}
                                    </p>

                                </div>

                            @else

                                <div class="mt-2">

                                    <small class="text-muted">
                                        Tidak ada komentar.
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <i
                        class="bi bi-star fs-1 text-muted"
                    ></i>

                    <h5 class="mt-3">
                        Belum ada rating
                    </h5>

                    <p class="text-muted mb-0">
                        Belum ada pengguna yang memberikan
                        rating kepada Anda.
                    </p>

                </div>

            @endforelse


            @if($rating->hasPages())

                <div class="mt-4">

                    {{ $rating->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection