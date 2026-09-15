@extends('layouts.kontributor')

@section('title', $title)

@section('content')

<form
    action="{{ route('kontributor.karya.update',$karya) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="container-fluid">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    Edit Karya

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    {{-- Thumbnail --}}

                    <div class="col-lg-4">

                        <div class="mb-3 text-center">

                            <img
                                src="{{ asset('storage/'.$karya->thumbnail) }}"
                                class="img-fluid rounded border"
                                style="max-height:250px;">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Ganti Thumbnail

                            </label>

                            <input
                                type="file"
                                name="thumbnail"
                                accept=".jpg,.jpeg,.png"
                                class="form-control @error('thumbnail') is-invalid @enderror">

                            @error('thumbnail')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div>

                            <label class="form-label">

                                Ganti File Karya

                            </label>

                            <input
                                type="file"
                                name="file_karya"
                                accept=".jpg,.jpeg,.png,.mp4,.mp3"
                                class="form-control @error('file_karya') is-invalid @enderror">

                            @error('file_karya')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                    </div>

                    {{-- Form --}}

                    <div class="col-lg-8">

                        <div class="mb-3">

                            <label class="form-label">

                                Judul Karya

                            </label>

                            <input
                                type="text"
                                name="judul_karya"
                                value="{{ old('judul_karya',$karya->judul_karya) }}"
                                class="form-control @error('judul_karya') is-invalid @enderror">

                            @error('judul_karya')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Kategori

                            </label>

                            <select
                                name="id_kategori_kontributor"
                                class="form-select @error('id_kategori_kontributor') is-invalid @enderror">

                                @foreach($kategori as $item)

                                    <option
                                        value="{{ $item->id_kategori_kontributor }}"
                                        @selected(old('id_kategori_kontributor',$karya->id_kategori_kontributor)==$item->id_kategori_kontributor)>

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

                        <div class="mb-3">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="deskripsi_karya"
                                rows="8"
                                class="form-control @error('deskripsi_karya') is-invalid @enderror">{{ old('deskripsi_karya',$karya->deskripsi_karya) }}</textarea>

                            @error('deskripsi_karya')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="alert alert-warning">

                            <strong>Perhatian</strong>

                            <p class="mb-0">

                                Setelah karya diperbarui, status akan kembali menjadi
                                <strong>Review</strong> dan menunggu persetujuan admin.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white text-end">

                <a
                    href="{{ route('kontributor.karya.show',$karya) }}"
                    class="btn btn-secondary">

                    Batal

                </a>

                <button
                    class="btn btn-primary">

                    <i class="bi bi-save"></i>

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</form>

@endsection