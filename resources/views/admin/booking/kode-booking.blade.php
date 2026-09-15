@extends('layouts.admin')

@section('content')

<style>
    @media print {

        body {
            background: #fff !important;
        }

        .sidebar,
        .admin-sidebar,
        nav,
        header,
        footer,
        .no-print,
        .btn,
        .breadcrumb {
            display: none !important;
        }

        .main-content,
        .content,
        .admin-content {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .print-area {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        @page {
            size: A4;
            margin: 20mm;
        }
    }
</style>


<div class="d-flex justify-content-between align-items-center mb-4 no-print">

    <div>

        <h4 class="mb-1">
            Kode Booking
        </h4>

        <small class="text-muted">
            Kode booking pendaftaran kunjungan yang telah disetujui.
        </small>

    </div>

    <a
        href="{{ route('admin.booking.index') }}"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left me-1"></i>

        Kembali

    </a>

</div>


<div class="print-area">

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center py-5">

            <div class="mb-3">

                <i
                    class="bi bi-ticket-perforated text-success"
                    style="font-size: 60px;">
                </i>

            </div>


            <h5 class="mb-2">
                KODE BOOKING
            </h5>


            <div class="display-4 fw-bold text-success mb-3">

                {{ $booking->id }}

            </div>


            <p class="text-muted mb-4">

                Kode booking pendaftaran kunjungan.

            </p>


            <div class="row justify-content-center">

                <div class="col-md-7 col-lg-6">

                    <div class="card bg-light border">

                        <div class="card-body text-start">


                            <div class="mb-3">

                                <small class="text-muted">
                                    Nama Pemesan
                                </small>

                                <div class="fw-semibold">
                                    {{ $booking->nama_pemesan }}
                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    No HP
                                </small>

                                <div class="fw-semibold">
                                    {{ $booking->no_hp }}
                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    Email
                                </small>

                                <div class="fw-semibold">
                                    {{ $booking->email }}
                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    Instansi
                                </small>

                                <div class="fw-semibold">
                                    {{ $booking->instansi }}
                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    Tujuan Kunjungan
                                </small>

                                <div class="fw-semibold">
                                    {{ $booking->tujuan }}
                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    Jumlah Pengunjung
                                </small>

                                <div class="fw-semibold">

                                    {{ $booking->dewasa }} Dewasa

                                    @if($booking->anak > 0)

                                        dan {{ $booking->anak }} Anak

                                    @endif

                                </div>

                            </div>


                            <div class="mb-3">

                                <small class="text-muted">
                                    Tanggal Kunjungan
                                </small>

                                <div class="fw-semibold">

                                    {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}

                                </div>

                            </div>


                            <div>

                                <small class="text-muted">
                                    Status
                                </small>

                                <div class="mt-1">

                                    <span class="badge bg-success">
                                        Disetujui
                                    </span>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>


            <div class="mt-4 no-print">

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="window.print()">

                    <i class="bi bi-printer me-1"></i>

                    Cetak Tiket

                </button>

            </div>

        </div>

    </div>

</div>

@endsection