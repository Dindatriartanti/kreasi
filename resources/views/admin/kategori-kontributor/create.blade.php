@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Tambah Kategori Kontributor

                    </h5>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('admin.kategori-kontributor.store') }}"
                        method="POST">

                        @csrf

                        {{-- ========================================= --}}
                        {{-- Kategori --}}
                        {{-- ========================================= --}}

                        <div class="mb-3">

                            <label class="form-label">

                                Kategori

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="id_kategori"
                                class="form-select @error('id_kategori') is-invalid @enderror"
                                required>

                                <option value="">

                                    -- Pilih Kategori --

                                </option>

                                @foreach($kategori as $item)

                                    <option
                                        value="{{ $item->id_kategori }}"
                                        {{ old('id_kategori') == $item->id_kategori ? 'selected' : '' }}>

                                        {{ $item->nama_kategori }}

                                    </option>

                                @endforeach

                            </select>

                            @error('id_kategori')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        {{-- ========================================= --}}
                        {{-- Nama --}}
                        {{-- ========================================= --}}

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Kategori Kontributor

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori') }}"
                                placeholder="Contoh : Batik"
                                required>

                            @error('nama_kategori')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        {{-- ========================================= --}}
                        {{-- Deskripsi --}}
                        {{-- ========================================= --}}

                        <div class="mb-3">

                            <label class="form-label">

                                Deskripsi

                            </label>

                            <textarea
                                name="deskripsi"
                                rows="5"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Masukkan deskripsi kategori...">{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        {{-- ========================================= --}}
                        {{-- Status --}}
                        {{-- ========================================= --}}

                        <div class="mb-4">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option
                                    value="aktif"
                                    {{ old('status') == 'aktif' ? 'selected' : '' }}>

                                    Aktif

                                </option>

                                <option
                                    value="nonaktif"
                                    {{ old('status') == 'nonaktif' ? 'selected' : '' }}>

                                    Nonaktif

                                </option>

                            </select>

                        </div>

                        {{-- ========================================= --}}
                        {{-- Button --}}
                        {{-- ========================================= --}}

                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('admin.kategori-kontributor.index') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-check-circle"></i>

                                Simpan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection