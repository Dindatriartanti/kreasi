@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="row">

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body text-center">

                <img
                    src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                    class="rounded-circle border mb-3"
                    width="170"
                    height="170"
                    style="object-fit:cover;">

                <h4 class="mb-1">

                    {{ $kontributor->nama_kontributor }}

                </h4>

                <div class="text-muted">

                    {{ '@'.$kontributor->user->username }}

                </div>

                <div class="mt-2">

                    @if($kontributor->status == 'aktif')

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    @endif

                </div>

            </div>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Informasi Akun

                </h5>

            </div>

            <table class="table mb-0">

                <tr>

                    <th width="120">

                        Username

                    </th>

                    <td>

                        {{ $kontributor->user->username }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Email

                    </th>

                    <td>

                        {{ $kontributor->email }}

                    </td>

                </tr>

                <tr>

                    <th>

                        No HP

                    </th>

                    <td>

                        {{ $kontributor->no_hp }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Slug

                    </th>

                    <td>

                        {{ $kontributor->slug }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Total Karya

                    </th>

                    <td>

                        <span class="badge bg-primary">

                            {{ $kontributor->karya->count() }}

                        </span>

                    </td>

                </tr>

            </table>

        </div>

        <div class="card shadow-sm border-0 mt-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Sertifikat / Bukti Hasil Karya
                </h5>
            </div>

            <div class="card-body">

                @if($kontributor->bukti_karya)
                    <a
                        href="{{ asset('storage/' . $kontributor->bukti_karya) }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-outline-primary w-100">
                        <i class="bi bi-file-earmark-text me-1"></i>
                        Lihat Dokumen
                    </a>
                @else
                    <div class="text-muted">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Belum ada sertifikat atau bukti hasil karya.
                    </div>
                @endif

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card shadow-sm border-0 mb-4">

            <img
                src="{{ asset('storage/' . ($kontributor->foto_banner ?: 'system/defaultBanner.jpg')) }}"
                class="img-fluid rounded-top">

            <div class="card-body">

                <h5>

                    Deskripsi

                </h5>

                @if($kontributor->deskripsi)

                    {!! nl2br(e($kontributor->deskripsi)) !!}

                @else

                    <span class="text-muted">

                        Belum ada deskripsi.

                    </span>

                @endif

            </div>

        </div>

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Informasi Kontak

                </h5>

            </div>

            <table class="table mb-0">

                <tr>

                    <th width="160">

                        Alamat

                    </th>

                    <td>

                        {{ $kontributor->alamat ?: '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Instagram

                    </th>

                    <td>

                        {{ $kontributor->instagram ?: '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Facebook

                    </th>

                    <td>

                        {{ $kontributor->facebook ?: '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Youtube

                    </th>

                    <td>

                        {{ $kontributor->youtube ?: '-' }}

                    </td>

                </tr>

                <tr>

                    <th>

                        Website

                    </th>

                    <td>

                        {{ $kontributor->website ?: '-' }}

                    </td>

                </tr>

            </table>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    Daftar Karya

                </h5>

                <span class="badge bg-primary">

                    {{ $kontributor->karya->count() }}

                </span>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th width="70">

                                Thumbnail

                            </th>

                            <th>

                                Judul

                            </th>

                            <th>

                                Kategori

                            </th>

                            <th>

                                Status

                            </th>

                            <th>

                                Tanggal

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($kontributor->karya as $karya)

                            <tr>

                                <td>

                                    <img
                                        src="{{ asset('storage/' . ($karya->thumbnail ?: 'system/noimage.jpg')) }}"
                                        width="60"
                                        class="rounded border">

                                </td>

                                <td>

                                    {{ $karya->judul_karya }}

                                </td>

                                <td>

                                    {{ $karya->kategoriKontributor->nama_kategori ?? '-' }}

                                </td>

                                <td>

                                    @if($karya->status == 'publish')

                                        <span class="badge bg-success">

                                            Publish

                                        </span>

                                    @elseif($karya->status == 'review')

                                        <span class="badge bg-warning">

                                            Review

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Ditolak

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $karya->tanggal_upload }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-4">

                                    Belum ada karya.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-4">

            <a
                href="{{ route('admin.kontributor.edit', $kontributor) }}"
                class="btn btn-warning">

                <i class="bi bi-pencil"></i>

                Edit Profil

            </a>

            <a
                href="{{ route('admin.kontributor.index') }}"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection