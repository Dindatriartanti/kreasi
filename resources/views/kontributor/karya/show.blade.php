@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                Detail Karya

            </h5>

            <div>

                <a
                    href="{{ route('kontributor.karya.edit',$karya) }}"
                    class="btn btn-warning">

                    <i class="bi bi-pencil-square"></i>

                    Edit

                </a>

                <a
                    href="{{ route('kontributor.karya.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Preview --}}
                <div class="col-lg-5">

                    @php

                        $ext = strtolower(pathinfo($karya->file_karya, PATHINFO_EXTENSION));

                    @endphp

                    {{-- Thumbnail --}}
                    <div class="mb-3">

                        <img
                            src="{{ asset('storage/'.$karya->thumbnail) }}"
                            class="img-fluid rounded border w-100">

                    </div>

                    {{-- Preview File --}}
                    @if(in_array($ext,['jpg','jpeg','png']))

                        <img
                            src="{{ asset('storage/'.$karya->file_karya) }}"
                            class="img-fluid rounded border w-100">

                    @elseif($ext=='mp4')

                        <video
                            controls
                            class="w-100 rounded">

                            <source
                                src="{{ asset('storage/'.$karya->file_karya) }}"
                                type="video/mp4">

                        </video>

                    @elseif($ext=='mp3')

                        <audio
                            controls
                            class="w-100">

                            <source
                                src="{{ asset('storage/'.$karya->file_karya) }}"
                                type="audio/mpeg">

                        </audio>

                    @endif

                </div>

                {{-- Informasi --}}
                <div class="col-lg-7">

                    <table class="table">

                        <tr>

                            <th width="180">

                                Judul

                            </th>

                            <td>

                                {{ $karya->judul_karya }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Kategori

                            </th>

                            <td>

                                {{ $karya->kategoriKontributor->nama_kategori }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                @if($karya->status=='publish')

                                    <span class="badge bg-success">

                                        Publish

                                    </span>

                                @elseif($karya->status=='review')

                                    <span class="badge bg-warning text-dark">

                                        Review

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Ditolak

                                    </span>

                                @endif

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tanggal Upload

                            </th>

                            <td>

                                {{ $karya->tanggal_upload->format('d F Y') }}

                            </td>

                        </tr>

                    </table>

                    <h5 class="mt-4">

                        Deskripsi

                    </h5>

                    <p>

                        {{ $karya->deskripsi_karya ?: '-' }}

                    </p>

                    <div class="mt-4">

                        <a
                            href="{{ asset('storage/'.$karya->file_karya) }}"
                            target="_blank"
                            class="btn btn-outline-primary">

                            <i class="bi bi-download"></i>

                            Lihat / Download File

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection