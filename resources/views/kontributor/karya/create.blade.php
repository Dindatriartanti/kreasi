@extends('layouts.kontributor')

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-10 mx-auto">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h4 class="mb-0">

                        Upload Karya

                    </h4>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('kontributor.karya.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        {{-- ================================ --}}
                        {{-- Kategori --}}
                        {{-- ================================ --}}

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Kategori Kontributor

                                </label>

                                <select
                                    name="id_kategori_kontributor"
                                    class="form-select @error('id_kategori_kontributor') is-invalid @enderror">

                                    <option value="">

                                        Pilih Kategori

                                    </option>

                                    @foreach($kategori as $item)

                                        <option
                                            value="{{ $item->id_kategori_kontributor }}"
                                            {{ old('id_kategori_kontributor')==$item->id_kategori_kontributor ? 'selected' : '' }}>

                                            {{ $item->kategori->nama_kategori }}

                                            -

                                            {{ $item->nama_kategori }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_kategori_kontributor')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Judul Karya

                                </label>

                                <input
                                    type="text"
                                    name="judul_karya"
                                    class="form-control @error('judul_karya') is-invalid @enderror"
                                    value="{{ old('judul_karya') }}">

                                @error('judul_karya')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                        </div>

                        {{-- ================================ --}}
                        {{-- Deskripsi --}}
                        {{-- ================================ --}}

                        <div class="mb-4">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="deskripsi_karya"
                                rows="5"
                                class="form-control">{{ old('deskripsi_karya') }}</textarea>

                        </div>

                        {{-- ================================ --}}
                        {{-- Thumbnail --}}
                        {{-- ================================ --}}

                        <div class="mb-4">

                            <label class="form-label">

                                Thumbnail

                            </label>

                            <input
                                type="file"
                                name="thumbnail"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">

                                JPG, PNG, WEBP maksimal 2 MB.

                            </small>

                        </div>

                        {{-- ================================ --}}
                        {{-- File --}}
                        {{-- ================================ --}}

                        <div class="mb-4">

                            <label class="form-label">

                                File Karya

                            </label>

                            <input
                                type="file"
                                name="file_karya"
                                class="form-control">

                            <small class="text-muted">

                                Gambar, Video, Audio, Dokumen maksimal 50 MB.

                            </small>

                        </div>

                        {{-- ================================ --}}
                        {{-- Button --}}
                        {{-- ================================ --}}

                        <div class="d-flex justify-content-end">

                            <a
                                href="{{ route('kontributor.karya.index') }}"
                                class="btn btn-secondary me-2">

                                Batal

                            </a>

                            <button
                                class="btn btn-primary">

                                Upload Karya

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection