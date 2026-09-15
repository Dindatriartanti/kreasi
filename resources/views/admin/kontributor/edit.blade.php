@extends('layouts.admin')

@section('title', $title)

@section('content')

<form
    action="{{ route('admin.kontributor.update', $kontributor) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row">

        {{-- FORM --}}

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Edit Profil Kontributor

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Kontributor

                        </label>

                        <input
                            type="text"
                            name="nama_kontributor"
                            class="form-control @error('nama_kontributor') is-invalid @enderror"
                            value="{{ old('nama_kontributor', $kontributor->nama_kontributor) }}">

                        @error('nama_kontributor')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Deskripsi

                        </label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi',$kontributor->deskripsi) }}</textarea>

                        @error('deskripsi')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Alamat

                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat',$kontributor->alamat) }}</textarea>

                        @error('alamat')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Media Sosial

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Instagram

                        </label>

                        <input
                            type="text"
                            name="instagram"
                            class="form-control"
                            value="{{ old('instagram',$kontributor->instagram) }}">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Facebook

                        </label>

                        <input
                            type="text"
                            name="facebook"
                            class="form-control"
                            value="{{ old('facebook',$kontributor->facebook) }}">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Youtube

                        </label>

                        <input
                            type="text"
                            name="youtube"
                            class="form-control"
                            value="{{ old('youtube',$kontributor->youtube) }}">

                    </div>

                    <div>

                        <label class="form-label">

                            Website

                        </label>

                        <input
                            type="text"
                            name="website"
                            class="form-control"
                            value="{{ old('website',$kontributor->website) }}">

                    </div>

                </div>

            </div>

        </div>

        {{-- SIDEBAR --}}

        <div class="col-lg-4">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Foto Profil

                    </h5>

                </div>

                <div class="card-body text-center">

                    <img
                        src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                        class="rounded-circle border mb-3"
                        width="170"
                        height="170"
                        style="object-fit:cover;">

                    <input
                        type="file"
                        name="foto_profil"
                        class="form-control">

                </div>

            </div>

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Banner

                    </h5>

                </div>

                <div class="card-body">

                    <img
                        src="{{ asset('storage/' . ($kontributor->foto_banner ?: 'system/defaultBanner.jpg')) }}"
                        class="img-fluid rounded border mb-3">

                    <input
                        type="file"
                        name="foto_banner"
                        class="form-control">

                </div>

            </div>

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Sertifikat / Bukti Hasil Karya
                    </h5>

                </div>

                <div class="card-body">

                    @if($kontributor->bukti_karya)
                        <div class="mb-3">
                            <a
                                href="{{ asset('storage/' . $kontributor->bukti_karya) }}"
                                target="_blank"
                                rel="noopener"
                                class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>
                                Lihat Dokumen Saat Ini
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning py-2">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Belum ada sertifikat atau bukti hasil karya.
                        </div>
                    @endif

                    <label class="form-label">
                        Upload / Ganti Dokumen
                    </label>

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

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Status

                    </h5>

                </div>

                <div class="card-body">

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="aktif"
                            @selected(old('status',$kontributor->status)=='aktif')>

                            Aktif

                        </option>

                        <option
                            value="nonaktif"
                            @selected(old('status',$kontributor->status)=='nonaktif')>

                            Nonaktif

                        </option>

                    </select>

                    <div class="d-grid gap-2 mt-4">

                        <button
                            class="btn btn-primary">

                            <i class="bi bi-check-circle me-1"></i>

                            Simpan Perubahan

                        </button>

                        <a
                            href="{{ route('admin.kontributor.index') }}"
                            class="btn btn-secondary">

                            <i class="bi bi-arrow-left me-1"></i>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection