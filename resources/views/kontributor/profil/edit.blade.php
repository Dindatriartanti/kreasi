@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<form
    action="{{ route('kontributor.profil.update') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="container-fluid">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Edit Profil

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    {{-- Foto --}}

                    <div class="col-lg-4">

                        <div class="text-center mb-4">

                            <img
                                src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                                class="rounded-circle border"
                                width="180"
                                height="180"
                                style="object-fit:cover;">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Foto Profil

                            </label>

                            <input
                                type="file"
                                name="foto_profil"
                                class="form-control @error('foto_profil') is-invalid @enderror">

                            @error('foto_profil')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div>

                            <label class="form-label">

                                Foto Banner

                            </label>

                            <input
                                type="file"
                                name="foto_banner"
                                class="form-control @error('foto_banner') is-invalid @enderror">

                            @error('foto_banner')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mt-4">

                            <label class="form-label">
                                Sertifikat / Bukti Hasil Karya
                            </label>

                            @if($kontributor->bukti_karya)
                                <div class="mb-2">
                                    <a
                                        href="{{ asset('storage/' . $kontributor->bukti_karya) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat Dokumen Saat Ini
                                    </a>
                                </div>
                            @endif

                            <input
                                type="file"
                                name="bukti_karya"
                                accept=".pdf,.jpg,.jpeg,.png,.webp"
                                class="form-control @error('bukti_karya') is-invalid @enderror">

                            <small class="text-muted">
                                PDF, JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
                            </small>

                            @error('bukti_karya')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- Form --}}

                    <div class="col-lg-8">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nama Kontributor

                                </label>

                                <input
                                    type="text"
                                    name="nama_kontributor"
                                    value="{{ old('nama_kontributor',$kontributor->nama_kontributor) }}"
                                    class="form-control @error('nama_kontributor') is-invalid @enderror">

                                @error('nama_kontributor')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $kontributor->email }}"
                                    readonly>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    No HP

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $kontributor->no_hp }}"
                                    readonly>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Alamat

                                </label>

                                <input
                                    type="text"
                                    name="alamat"
                                    value="{{ old('alamat',$kontributor->alamat) }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="deskripsi"
                                rows="5"
                                class="form-control">{{ old('deskripsi',$kontributor->deskripsi) }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Instagram

                                </label>

                                <input
                                    type="text"
                                    name="instagram"
                                    value="{{ old('instagram',$kontributor->instagram) }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Facebook

                                </label>

                                <input
                                    type="text"
                                    name="facebook"
                                    value="{{ old('facebook',$kontributor->facebook) }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Youtube

                                </label>

                                <input
                                    type="text"
                                    name="youtube"
                                    value="{{ old('youtube',$kontributor->youtube) }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Website

                                </label>

                                <input
                                    type="text"
                                    name="website"
                                    value="{{ old('website',$kontributor->website) }}"
                                    class="form-control">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white text-end">

                <a
                    href="{{ route('kontributor.profil.show') }}"
                    class="btn btn-secondary">

                    Batal

                </a>

                <button
                    class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</form>

@endsection