@extends('layouts.admin')

@section('title', $title)

@section('content')

<form
    action="{{ route('admin.karya.update', $karya) }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="row">

        {{-- =====================================================
             INFORMASI KARYA
             ===================================================== --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Informasi Karya
                    </h5>

                </div>

                <div class="card-body">

                    {{-- Thumbnail --}}
                    <div class="text-center mb-4">

                        <img
                            src="{{ asset(
                                'storage/' .
                                ($karya->thumbnail ?: 'system/noimage.jpg')
                            ) }}"
                            alt="{{ $karya->judul_karya }}"
                            class="img-fluid rounded border"
                            style="max-height:350px; object-fit:cover;">

                    </div>


                    {{-- Judul --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Judul Karya
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $karya->judul_karya }}"
                            readonly>

                    </div>


                    {{-- Kontributor --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Kontributor
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $karya->kontributor->nama_kontributor }}"
                            readonly>

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea
                            class="form-control"
                            rows="7"
                            readonly>{{ $karya->deskripsi_karya }}</textarea>

                    </div>


                    {{-- File Karya --}}
                    <div>

                        <label class="form-label">
                            File Karya
                        </label>

                        <div>

                            <a
                                href="{{ asset('storage/' . $karya->file_karya) }}"
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


        {{-- =====================================================
             MODERASI
             ===================================================== --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Moderasi
                    </h5>

                </div>

                <div class="card-body">

                    {{-- Kategori --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Kategori

                        </label>

                        <select
                            name="id_kategori_kontributor"
                            class="form-select @error('id_kategori_kontributor') is-invalid @enderror">

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($kategoriKontributors as $kategori)

                                <option
                                    value="{{ $kategori->id_kategori_kontributor }}"
                                    @selected(
                                        old(
                                            'id_kategori_kontributor',
                                            $karya->id_kategori_kontributor
                                        ) == $kategori->id_kategori_kontributor
                                    )>

                                    {{ $kategori->nama_kategori }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_kategori_kontributor')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select @error('status') is-invalid @enderror">

                            <option
                                value="review"
                                @selected(
                                    old('status', $karya->status) == 'review'
                                )>

                                Review

                            </option>

                            <option
                                value="publish"
                                @selected(
                                    old('status', $karya->status) == 'publish'
                                )>

                                Publish

                            </option>

                            <option
                                value="ditolak"
                                @selected(
                                    old('status', $karya->status) == 'ditolak'
                                )>

                                Ditolak

                            </option>

                        </select>

                        @error('status')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Tombol --}}
                    <div class="d-grid gap-2">

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-circle"></i>

                            Simpan Moderasi

                        </button>

                        <a
                            href="{{ route('admin.karya.show', $karya) }}"
                            class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection