@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm overflow-hidden">

        {{-- Banner --}}

        <div style="height:260px;">

            <img
                src="{{ asset('storage/' . ($kontributor->foto_banner ?: 'system/defaultBanner.jpg')) }}"
                class="w-100 h-100"
                style="object-fit:cover;">

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-lg-3 text-center">

                    <img
                        src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                        class="rounded-circle border border-4 border-white shadow"
                        width="170"
                        height="170"
                        style="object-fit:cover;margin-top:-90px;">

                </div>

                <div class="col-lg-9">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h2 class="fw-bold">

                                {{ $kontributor->nama_kontributor }}

                            </h2>

                            <p class="text-muted">

                                {{ $kontributor->deskripsi ?: 'Belum ada deskripsi.' }}

                            </p>

                        </div>

                        <div>

                            <a
                                href="{{ route('kontributor.profil.edit') }}"
                                class="btn btn-primary">

                                <i class="bi bi-pencil-square"></i>

                                Edit Profil

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <hr>

            @if($kontributor->bukti_karya)
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h6 class="fw-bold mb-1">
                                    <i class="bi bi-award me-1"></i>
                                    Sertifikat / Bukti Hasil Karya
                                </h6>
                                <small class="text-muted">
                                    Dokumen sertifikat atau bukti hasil karya yang tersimpan.
                                </small>
                            </div>

                            <a
                                href="{{ asset('storage/' . $kontributor->bukti_karya) }}"
                                target="_blank"
                                rel="noopener"
                                class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">

                <div class="col-md-6 mb-4">

                    <h6 class="fw-bold">

                        Informasi Kontak

                    </h6>

                    <table class="table">

                        <tr>

                            <th width="150">

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

                                Alamat

                            </th>

                            <td>

                                {{ $kontributor->alamat ?: '-' }}

                            </td>

                        </tr>

                    </table>

                </div>

                <div class="col-md-6 mb-4">

                    <h6 class="fw-bold">

                        Media Sosial

                    </h6>

                    <table class="table">

                        <tr>

                            <th width="150">

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

            </div>

        </div>

    </div>

</div>

@endsection