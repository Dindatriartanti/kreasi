@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="row g-4">

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Total User

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ $totalUser }}

                            </h3>

                        </div>

                        <div class="icon-box bg-primary">

                            <i class="bi bi-people-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Kontributor

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ $totalKontributor }}

                            </h3>

                        </div>

                        <div class="icon-box bg-success">

                            <i class="bi bi-person-badge-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Karya

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ $totalKarya }}

                            </h3>

                        </div>

                        <div class="icon-box bg-warning">

                            <i class="bi bi-images"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Koleksi

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ $totalKoleksi }}

                            </h3>

                        </div>

                        <div class="icon-box bg-danger">

                            <i class="bi bi-collection-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4 mt-2">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Grafik Jumlah Karya

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="chartKarya"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Status Karya

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="chartStatus"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-12">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Karya Terbaru

                    </h5>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Judul</th>

                                <th>Kontributor</th>

                                <th>Kategori</th>

                                <th>Status</th>

                                <th>Tanggal</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($latestKarya as $item)

                            <tr>

                                <td>{{ $item->judul }}</td>

                                <td>{{ $item->kontributor->nama }}</td>

                                <td>{{ $item->kategoriKontributor->nama }}</td>

                                <td>

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

                                </td>

                                <td>

                                    {{ $item->created_at->format('d M Y') }}

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Belum ada data.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection