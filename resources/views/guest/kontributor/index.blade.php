@extends('layouts.app')

@section('title', $title)

@section('content')

<section class="py-5 bg-light">

    <div class="container">

        <div class="row justify-content-center text-center">

            <div class="col-lg-8">

                <h1 class="fw-bold mb-3">

                    Galeri Kontributor

                </h1>

                <p class="text-muted">

                    Temukan karya kreatif terbaik dari para pelaku ekonomi kreatif Kabupaten Cirebon.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="py-4">

    <div class="container">

        <form
            method="GET"
            class="row g-3 mb-5">

            <div class="col-lg-10">

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    class="form-control"
                    placeholder="Cari nama kontributor...">

            </div>

            <div class="col-lg-2 d-grid">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                    Cari

                </button>

            </div>

        </form>

        <div class="row">

            @forelse($kontributors as $kontributor)

                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <img
                            src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                            class="card-img-top"
                            style="height:260px;object-fit:cover;">

                        <div class="card-body">

                            <h5 class="fw-bold">

                                {{ $kontributor->nama_kontributor }}

                            </h5>

                            <p class="text-muted small">

                                {{ Str::limit($kontributor->deskripsi,80) }}

                            </p>

                            <span class="badge bg-primary">

                                {{ $kontributor->karya_publish_count }}

                                Karya

                            </span>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="{{ route('guest.gallery.kontributor.show',$kontributor) }}"
                                class="btn btn-outline-primary w-100">

                                Lihat Profil

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-search display-1 text-secondary"></i>

                        <h4 class="mt-4">

                            Kontributor tidak ditemukan.

                        </h4>

                    </div>

                </div>

            @endforelse

        </div>

        <div class="mt-4">

            {{ $kontributors->links() }}

        </div>

    </div>

</section>

@endsection