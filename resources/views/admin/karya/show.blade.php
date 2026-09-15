@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="row">

    {{-- Karya --}}

    <div class="col-lg-8">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h4 class="mb-0">

                    {{ $karya->judul_karya }}

                </h4>

            </div>

            <div class="card-body">

                <img
                    src="{{ asset('storage/' . ($karya->thumbnail ?: 'system/noimage.jpg')) }}"
                    class="img-fluid rounded border mb-4">

                <h5>

                    Deskripsi

                </h5>

                @if($karya->deskripsi_karya)

                    {!! nl2br(e($karya->deskripsi_karya)) !!}

                @else

                    <p class="text-muted">

                        Belum ada deskripsi.

                    </p>

                @endif

                <hr>

                <h5>

                    File Karya

                </h5>

                @php

                    $extension = strtolower(pathinfo($karya->file_karya, PATHINFO_EXTENSION));

                @endphp

                @if(in_array($extension,['jpg','jpeg','png','gif','webp']))

                    <img
                        src="{{ asset('storage/'.$karya->file_karya) }}"
                        class="img-fluid rounded border">

                @elseif(in_array($extension,['mp4','webm']))

                    <video
                        controls
                        class="w-100 rounded">

                        <source
                            src="{{ asset('storage/'.$karya->file_karya) }}">

                    </video>

                @elseif(in_array($extension,['mp3','wav']))

                    <audio
                        controls
                        class="w-100">

                        <source
                            src="{{ asset('storage/'.$karya->file_karya) }}">

                    </audio>

                @elseif($extension=='pdf')

                    <iframe
                        src="{{ asset('storage/'.$karya->file_karya) }}"
                        width="100%"
                        height="700"
                        class="border rounded">

                    </iframe>

                @else

                    <a
                        href="{{ asset('storage/'.$karya->file_karya) }}"
                        target="_blank"
                        class="btn btn-primary">

                        Download File

                    </a>

                @endif

            </div>

        </div>

    </div>

    {{-- Sidebar --}}

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                Informasi Karya

            </div>

            <table class="table mb-0">

                <tr>

                    <th width="150">

                        Kontributor

                    </th>

                    <td>

                        {{ $karya->kontributor->nama_kontributor }}

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

                        Upload

                    </th>

                    <td>

                        {{ $karya->tanggal_upload->format('d F Y') }}

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

                        Slug

                    </th>

                    <td>

                        <small>

                            {{ $karya->slug }}

                        </small>

                    </td>

                </tr>

            </table>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body d-grid gap-2">

                <a
                    href="{{ route('admin.karya.edit',$karya) }}"
                    class="btn btn-warning">

                    <i class="bi bi-pencil"></i>

                    Moderasi

                </a>

                @if($karya->file_karya)

                    <a
                        href="{{ asset('storage/'.$karya->file_karya) }}"
                        target="_blank"
                        class="btn btn-primary">

                        <i class="bi bi-download"></i>

                        Download File

                    </a>

                @endif

                <a
                    href="{{ route('admin.karya.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</div>

@endsection