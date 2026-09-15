@extends('layouts.app')

@push('styles')
    @vite('resources/css/tentang.css')
@endpush

@section('content')

<section class="about-header">

    <div class="container">

        <h1>

            Tentang Kami

        </h1>

        <p>

            Mengenal Ruang Kreasi Kabupaten Cirebon sebagai media digital
            untuk memperkenalkan potensi ekonomi kreatif, budaya,
            serta koleksi museum.

        </p>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <img
                    src="{{ asset('assets/hero/museum1.jpg') }}"
                    class="img-fluid rounded-4 shadow">

            </div>

            <div class="col-lg-6">

                <h2>

                    Ruang Kreasi Kabupaten Cirebon

                </h2>

                <p>

                    Ruang Kreasi merupakan platform digital yang menjadi
                    media promosi, dokumentasi, dan publikasi karya
                    pelaku ekonomi kreatif serta koleksi budaya daerah.

                </p>

                <p>

                    Platform ini memudahkan masyarakat dalam mengakses
                    informasi mengenai museum, kegiatan, dan karya kreatif
                    Kabupaten Cirebon secara digital.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="py-5 bg-light">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-6">

                <div class="about-card">

                    <i class="bi bi-eye-fill"></i>

                    <h4>

                        Visi

                    </h4>

                    <p>

                        Menjadi platform digital yang mendukung pelestarian
                        budaya dan pengembangan ekonomi kreatif Kabupaten
                        Cirebon.

                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="about-card">

                    <i class="bi bi-bullseye"></i>

                    <h4>

                        Misi

                    </h4>

                    <ul>

                        <li>Mempromosikan karya ekonomi kreatif.</li>

                        <li>Melestarikan budaya daerah.</li>

                        <li>Menyediakan informasi kegiatan.</li>

                        <li>Meningkatkan akses masyarakat.</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <h2 class="text-center mb-5">

            Layanan Ruang Kreasi

        </h2>

        <div class="row g-4">

            <div class="col-md-3">

                <div class="about-service">

                    <i class="bi bi-bank"></i>

                    <h5>

                        Museum

                    </h5>

                </div>

            </div>

            <div class="col-md-3">

                <div class="about-service">

                    <i class="bi bi-palette"></i>

                    <h5>

                        Gallery

                    </h5>

                </div>

            </div>

            <div class="col-md-3">

                <div class="about-service">

                    <i class="bi bi-calendar-event"></i>

                    <h5>

                        Kegiatan

                    </h5>

                </div>

            </div>

            <div class="col-md-3">

                <div class="about-service">

                    <i class="bi bi-envelope"></i>

                    <h5>

                        Kontak

                    </h5>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection