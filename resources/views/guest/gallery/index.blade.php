@extends('layouts.app')

@section('title', 'Gallery')

@section('content')

{{-- Hero --}}
<section class="py-5 bg-light">

    <div class="container">

        <div class="row justify-content-center text-center">

            <div class="col-lg-8">

                <h1 class="display-5 fw-bold">

                    Gallery Ruang Kreasi

                </h1>

                <p class="lead text-muted mt-3">

                    Jelajahi koleksi museum dan karya para pelaku ekonomi kreatif
                    Kabupaten Cirebon dalam satu galeri digital.

                </p>

            </div>

        </div>

    </div>

</section>

{{-- Menu Gallery --}}
<section class="py-5">

    <div class="container">

        <div class="row g-4">

            {{-- Museum --}}
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <img
                        src="{{ asset('assets/hero/rk.jpg') }}"
                        class="card-img-top"
                        style="height:320px;object-fit:cover;">

                    <div class="card-body">

                        <h3 class="fw-bold">

                            Gallery Museum

                        </h3>

                        <p class="text-muted">

                            Koleksi benda bersejarah dan peninggalan budaya
                            Kabupaten Cirebon.

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="{{ route('guest.gallery.museum.index') }}"
                            class="btn btn-primary">

                            Lihat Koleksi

                        </a>

                    </div>

                </div>

            </div>

            {{-- Kontributor --}}
            <div class="col-lg-6">

                <div class="card border-0 shadow-sm h-100">

                    <img
                        src="{{ asset('assets/hero/contri.jpg') }}"
                        class="card-img-top"
                        style="height:320px;object-fit:cover;">

                    <div class="card-body">

                        <h3 class="fw-bold">

                            Gallery Kontributor

                        </h3>

                        <p class="text-muted">

                            Jelajahi karya para pelaku ekonomi kreatif
                            Kabupaten Cirebon dari berbagai subsektor.

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0">

                        <a
                            href="{{ route('guest.gallery.kontributor.index') }}"
                            class="btn btn-success">

                            Jelajahi Karya

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- Informasi --}}
<section class="py-5 bg-light">

    <div class="container">

        <div class="row text-center">

            <div class="col-lg-3">

                <i class="bi bi-bank display-4 text-primary"></i>

                <h5 class="mt-3">

                    Museum

                </h5>

                <p class="text-muted">

                    Koleksi sejarah Kabupaten Cirebon.

                </p>

            </div>

            <div class="col-lg-3">

                <i class="bi bi-palette display-4 text-success"></i>

                <h5 class="mt-3">

                    Ekonomi Kreatif

                </h5>

                <p class="text-muted">

                    Karya dari berbagai subsektor kreatif.

                </p>

            </div>

            <div class="col-lg-3">

                <i class="bi bi-images display-4 text-warning"></i>

                <h5 class="mt-3">

                    Digital Gallery

                </h5>

                <p class="text-muted">

                    Akses koleksi kapan saja.

                </p>

            </div>

            <div class="col-lg-3">

                <i class="bi bi-geo-alt display-4 text-danger"></i>

                <h5 class="mt-3">

                    Kabupaten Cirebon

                </h5>

                <p class="text-muted">

                    Mengenalkan budaya dan potensi daerah.

                </p>

            </div>

        </div>

    </div>

</section>

@endsection