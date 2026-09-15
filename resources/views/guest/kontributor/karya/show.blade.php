@extends('layouts.app')

@section('title', $title)

@section('content')

<section class="py-5">

    <div class="container">

        <div class="row">

            {{-- Preview Karya --}}
            <div class="col-lg-8 mb-4">

                <div class="card border-0 shadow-sm">

                    @php

                        $extension = strtolower(pathinfo($karya->file_karya, PATHINFO_EXTENSION));

                    @endphp

                    {{-- IMAGE --}}
                    @if(in_array($extension,['jpg','jpeg','png','webp']))

                        <img
                            src="{{ asset('storage/'.$karya->file_karya) }}"
                            class="img-fluid rounded">

                    {{-- VIDEO --}}
                    @elseif($extension == 'mp4')

                        <video
                            controls
                            class="w-100 rounded">

                            <source
                                src="{{ asset('storage/'.$karya->file_karya) }}"
                                type="video/mp4">

                        </video>

                    {{-- AUDIO --}}
                    @elseif($extension == 'mp3')

                        <div class="p-5 text-center">

                            <i class="bi bi-music-note-beamed display-1 text-primary"></i>

                            <audio
                                controls
                                class="w-100 mt-4">

                                <source
                                    src="{{ asset('storage/'.$karya->file_karya) }}"
                                    type="audio/mpeg">

                            </audio>

                        </div>

                    @else

                        <div class="text-center p-5">

                            <i class="bi bi-file-earmark display-1"></i>

                            <p class="mt-3">

                                File tidak dapat dipreview.

                            </p>

                        </div>

                    @endif

                </div>

            </div>

            {{-- Informasi --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <span class="badge bg-primary mb-3">

                            {{ $karya->kategoriKontributor->nama_kategori }}

                        </span>

                        <h2 class="fw-bold">

                            {{ $karya->judul_karya }}

                        </h2>

                        <p class="text-muted">

                            Dipublikasikan

                            {{ $karya->tanggal_upload->format('d F Y') }}

                        </p>

                        <hr>

                        <div class="d-flex align-items-center mb-4">

                            <img
                                src="{{ asset('storage/'.($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                                width="60"
                                height="60"
                                class="rounded-circle"
                                style="object-fit:cover;">

                            <div class="ms-3">

                                <strong>

                                    {{ $kontributor->nama_kontributor }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    Kontributor

                                </small>

                            </div>

                        </div>

                        <a
                            href="{{ route('guest.gallery.kontributor.show',$kontributor) }}"
                            class="btn btn-outline-primary w-100">

                            Lihat Profil Kontributor

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="pb-5">

    <div class="container">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h3 class="fw-bold mb-4">

                    Deskripsi Karya

                </h3>

                <p style="white-space: pre-line">

                    {{ $karya->deskripsi_karya }}

                </p>

            </div>

        </div>

    </div>

</section>

<section class="pb-5">

    <div class="container">

        <h3 class="fw-bold mb-4">

            Karya Lainnya

        </h3>

        <div class="row">

            @forelse($karyaLainnya as $item)

                <div class="col-lg-3 col-md-4 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <img
                            src="{{ asset('storage/'.$item->thumbnail) }}"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;">

                        <div class="card-body">

                            <small class="text-muted">

                                {{ $item->kategoriKontributor->nama_kategori }}

                            </small>

                            <h6 class="fw-bold mt-2">

                                {{ Str::limit($item->judul_karya,40) }}

                            </h6>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="{{ route('guest.gallery.kontributor.karya.show',[
                                    $kontributor,
                                    $item
                                ]) }}"
                                class="btn btn-primary w-100">

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-light border">

                        Belum ada karya lainnya.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection