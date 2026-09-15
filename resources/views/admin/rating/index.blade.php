@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Rating Kontributor
            </h3>

            <p class="text-muted mb-0">
                Kelola rating dan komentar yang diberikan
                pengguna kepada kontributor.
            </p>

        </div>

    </div>


    {{-- ALERT --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- STATISTIK --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Total Rating
                    </small>

                    <h3 class="fw-bold mb-0 mt-1">
                        {{ $totalRating }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Rating Ditampilkan
                    </small>

                    <h3 class="fw-bold text-success mb-0 mt-1">
                        {{ $ratingTampil }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">
                        Rating Disembunyikan
                    </small>

                    <h3 class="fw-bold text-danger mb-0 mt-1">
                        {{ $ratingDisembunyikan }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('admin.rating.index') }}"
                method="GET"
            >

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Cari
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ $search }}"
                            placeholder="Cari kontributor, pengguna, atau komentar..."
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="tampil"
                                {{ $status === 'tampil'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Tampil
                            </option>

                            <option
                                value="disembunyikan"
                                {{ $status === 'disembunyikan'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Disembunyikan
                            </option>

                        </select>

                    </div>


                    <div class="col-md-2 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            <i class="bi bi-search me-1"></i>

                            Cari
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-3">
                                #
                            </th>

                            <th>
                                Pengguna
                            </th>

                            <th>
                                Kontributor
                            </th>

                            <th>
                                Rating
                            </th>

                            <th>
                                Komentar
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($rating as $item)

                            <tr>

                                <td class="px-3">
                                    {{ $rating->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="fw-semibold">

                                        {{
                                            $item->user->name
                                            ?? 'Pengguna'
                                        }}

                                    </div>

                                </td>


                                <td>

                                    <div class="fw-semibold">

                                        {{
                                            $item->kontributor
                                                ->nama_kontributor
                                                ?? '-'
                                        }}

                                    </div>

                                </td>


                                <td>

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

                                    <small class="text-muted">

                                        {{ $item->rating }}/5

                                    </small>

                                </td>


                                <td style="min-width: 250px;">

                                    @if($item->komentar)

                                        {{ $item->komentar }}

                                    @else

                                        <span class="text-muted">
                                            Tidak ada komentar
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if(
                                        $item->status === 'tampil'
                                    )

                                        <span
                                            class="badge bg-success"
                                        >
                                            Tampil
                                        </span>

                                    @else

                                        <span
                                            class="badge bg-danger"
                                        >
                                            Disembunyikan
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <small>

                                        {{
                                            $item->created_at
                                                ? $item->created_at
                                                    ->format(
                                                        'd M Y'
                                                    )
                                                : '-'
                                        }}

                                    </small>

                                </td>


                                <td>

                                    <div
                                        class="d-flex justify-content-center gap-1"
                                    >

                                        {{-- UBAH STATUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.rating.update',
                                                $item
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('PUT')


                                            @if(
                                                $item->status === 'tampil'
                                            )

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="disembunyikan"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-warning btn-sm"
                                                    title="Sembunyikan"
                                                >

                                                    <i
                                                        class="bi bi-eye-slash"
                                                    ></i>

                                                </button>

                                            @else

                                                <input
                                                    type="hidden"
                                                    name="status"
                                                    value="tampil"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-success btn-sm"
                                                    title="Tampilkan"
                                                >

                                                    <i
                                                        class="bi bi-eye"
                                                    ></i>

                                                </button>

                                            @endif

                                        </form>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route(
                                                'admin.rating.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                'Yakin ingin menghapus rating ini?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Hapus"
                                            >

                                                <i
                                                    class="bi bi-trash"
                                                ></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="bi bi-star fs-1 text-muted"
                                    ></i>

                                    <h5 class="mt-3">
                                        Belum ada rating
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Data rating kontributor
                                        belum tersedia.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($rating->hasPages())

            <div class="card-footer bg-white">

                {{ $rating->links() }}

            </div>

        @endif

    </div>

</div>

@endsection