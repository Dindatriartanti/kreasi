@extends('layouts.app')

@section('title', $title)

@section('content')

<section class="py-5 bg-light">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h2 class="fw-bold mb-2">

                    Kumpulan Karya

                </h2>

                <h5 class="text-primary">

                    {{ $kontributor->nama_kontributor }}

                </h5>

                <p class="text-muted">

                    Seluruh karya yang telah dipublikasikan oleh kontributor.

                </p>

            </div>

            <div class="col-lg-4 text-lg-end">

                <a
                    href="{{ route('guest.kontributor.show',$kontributor) }}"
                    class="btn btn-outline-primary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali ke Profil

                </a>

            </div>

        </div>

    </div>

</section>

<section class="py-5">

    <div class="container">

        <div class="row">

            @forelse($karya as $item)

                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <img
                            src="{{ asset('storage/'.$item->thumbnail) }}"
                            class="card-img-top"
                            style="height:230px;object-fit:cover;">

                        <div class="card-body">

                            <small class="text-muted">

                                {{ $item->kategoriKontributor->nama_kategori }}

                            </small>

                            <h5 class="fw-bold mt-2">

                                {{ Str::limit($item->judul_karya,40) }}

                            </h5>

                            <small class="text-muted">

                                {{ $item->tanggal_upload->format('d M Y') }}

                            </small>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="{{ route('guest.kontributor.karya.show',[
                                    $kontributor,
                                    $item
                                ]) }}"
                                class="btn btn-primary w-100">

                                Detail Karya

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-images display-1 text-secondary"></i>

                        <h4 class="mt-4">

                            Belum ada karya dipublikasikan.

                        </h4>

                    </div>

                </div>

            @endforelse

        </div>

        <div class="mt-4">

            {{ $karya->links() }}

        </div>

    </div>

</section>

@endsection