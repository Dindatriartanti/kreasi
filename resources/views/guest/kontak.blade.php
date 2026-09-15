@extends('layouts.app')

@push('styles')
    @vite('resources/css/kontak.css')
@endpush

@section('content')

{{-- Hero --}}
<section class="page-header">
    <div class="container">
        <h1>Kontak</h1>
        <p>
            Hubungi kami untuk informasi, pengaduan, maupun pendaftaran kunjungan ke Ruang Kreasi Kabupaten Cirebon.
        </p>
    </div>
</section>

{{-- Service --}}
<section class="contact-service py-5">

    <div class="container">

        <div class="service-heading">

            <h2>Layanan Pengaduan dan Informasi</h2>

            <p>
                Terima kasih telah menghubungi kami. Silakan gunakan menu di bawah
                ini sesuai kebutuhan Anda.
            </p>

        </div>

        <div class="row g-4">

            {{-- Sidebar --}}
            <div class="col-lg-3">

                <div class="service-menu nav flex-column nav-pills">

                    <button
                        class="nav-link active"
                        id="pengaduan-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pengaduan">

                        <i class="bi bi-chat-left-text"></i>

                        Layanan Pengaduan

                    </button>

                    <button
                        class="nav-link"
                        id="booking-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#booking">

                        <i class="bi bi-calendar-check"></i>

                        Pendaftaran Kunjungan

                    </button>

                    <button
                        class="nav-link"
                        id="alamat-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#alamat">

                        <i class="bi bi-geo-alt"></i>

                        Informasi Alamat

                    </button>

                </div>

            </div>

            {{-- Content --}}
            <div class="col-lg-9">

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif

                <div class="service-content">

                    <div class="tab-content">

                        <div
                            class="tab-pane fade show active"
                            id="pengaduan">

                            @include('guest.components.kontak.pengaduan')

                        </div>

                        <div
                            class="tab-pane fade"
                            id="booking">

                            @include('guest.components.kontak.booking')

                        </div>

                        <div
                            class="tab-pane fade"
                            id="alamat">

                            @include('guest.components.kontak.alamat')

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection