@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    {{-- =========================
         Banner & Profil
    ========================== --}}

    <div class="card border-0 shadow-sm overflow-hidden mb-4">

        <div class="dashboard-banner">

            <img
                src="{{ asset('storage/' . ($kontributor->foto_banner ?: 'system/defaultBanner.jpg')) }}"
                class="w-100 h-100"
                style="object-fit:cover;">

        </div>

        <div class="card-body position-relative">

            <div class="dashboard-profile">

                <img
                    src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                    class="profile-photo">

                <div class="flex-grow-1">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <h3 class="fw-bold mb-1">

                                {{ $kontributor->nama_kontributor }}

                            </h3>

                            <p class="text-muted mb-3">

                                {{ $kontributor->deskripsi ?: 'Belum ada deskripsi.' }}

                            </p>

                        </div>

                        <a
                            href="{{ route('kontributor.profil.edit') }}"
                            class="btn btn-primary">

                            <i class="bi bi-pencil-square"></i>

                            Kelola Profil

                        </a>

                    </div>

                    <div class="row mt-2">

                        <div class="col-md-3">

                            <small class="text-muted">

                                Email

                            </small>

                            <div>

                                {{ $kontributor->email }}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">

                                No HP

                            </small>

                            <div>

                                {{ $kontributor->no_hp }}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">

                                Alamat

                            </small>

                            <div>

                                {{ $kontributor->alamat ?: '-' }}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">

                                Status

                            </small>

                            <div>

                                @if($kontributor->status=='aktif')

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Nonaktif

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         Statistik
    ========================== --}}

    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card dashboard-stat">

                <div class="card-body">

                    <i class="bi bi-images stat-icon text-primary"></i>

                    <h2>{{ $totalKarya }}</h2>

                    <small>Total Karya</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card dashboard-stat">

                <div class="card-body">

                    <i class="bi bi-check-circle stat-icon text-success"></i>

                    <h2>{{ $publish }}</h2>

                    <small>Publish</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card dashboard-stat">

                <div class="card-body">

                    <i class="bi bi-clock-history stat-icon text-warning"></i>

                    <h2>{{ $review }}</h2>

                    <small>Review</small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card dashboard-stat">

                <div class="card-body">

                    <i class="bi bi-x-circle stat-icon text-danger"></i>

                    <h2>{{ $ditolak }}</h2>

                    <small>Ditolak</small>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         Kilas Karya
    ========================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                Kilas Karya

            </h5>

            <a
                href="{{ route('kontributor.karya.index') }}"
                class="text-decoration-none">

                Lihat Semua

            </a>

        </div>

        <div class="card-body">

            <div class="row">

                @forelse($kilasKarya as $item)

                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-4">

                        <div class="card h-100 border-0 shadow-sm">

                            <img
                                src="{{ asset('storage/' . ($item->thumbnail ?: 'system/noimage.jpg')) }}"
                                class="card-img-top"
                                style="height:170px;object-fit:cover;">

                            <div class="card-body">

                                <h6>

                                    {{ Str::limit($item->judul_karya,25) }}

                                </h6>

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

                    </div>

                @empty

                    <div class="col-12 text-center py-5">

                        <i class="bi bi-images display-4 text-secondary"></i>

                        <h5 class="mt-3">

                            Belum ada karya.

                        </h5>

                        <a
                            href="{{ route('kontributor.karya.create') }}"
                            class="btn btn-primary mt-3">

                            Upload Karya

                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection