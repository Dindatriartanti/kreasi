@extends('layouts.auth')

@section('content')

<div class="text-center mb-4">

    <h2 class="auth-title">Daftar Kontributor</h2>

    <p class="auth-subtitle">
        Buat akun untuk bergabung dengan Ruang Kreasi Kabupaten Cirebon.
    </p>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<form
    action="{{ route('register') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf


    <div class="mb-3">

        <label class="form-label">
            Nama Lengkap
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>

            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Masukkan nama lengkap">

        </div>

        @error('name')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Username
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-at"></i>
            </span>

            <input
                type="text"
                name="username"
                class="form-control @error('username') is-invalid @enderror"
                value="{{ old('username') }}"
                placeholder="Masukkan username">

        </div>

        @error('username')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Email
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>

            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                placeholder="Masukkan email">

        </div>

        @error('email')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Nomor HP
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-telephone"></i>
            </span>

            <input
                type="text"
                name="no_hp"
                class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp') }}"
                placeholder="08xxxxxxxxxx">

        </div>

        @error('no_hp')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Sertifikat / Bukti Hasil Karya
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-file-earmark-check"></i>
            </span>

            <input
                type="file"
                name="bukti_karya"
                class="form-control @error('bukti_karya') is-invalid @enderror"
                accept=".pdf,.jpg,.jpeg,.png,.webp">

        </div>

        <small class="text-muted">
            Upload sertifikat atau bukti hasil karya. Format PDF, JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
        </small>

        @error('bukti_karya')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-3">

        <label class="form-label">
            Password
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>

            <input
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password">

            <span class="input-group-text toggle-password">
                <i class="bi bi-eye"></i>
            </span>

        </div>

        @error('password')

        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>

        @enderror

    </div>


    <div class="mb-4">

        <label class="form-label">
            Konfirmasi Password
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-shield-lock"></i>
            </span>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="Ulangi password">

            <span class="input-group-text toggle-password">
                <i class="bi bi-eye"></i>
            </span>

        </div>

    </div>


    <button
        type="submit"
        class="btn btn-primary btn-login w-100">

        DAFTAR

    </button>

</form>


<div class="auth-footer">

    Sudah mempunyai akun?

    <a href="{{ route('login') }}">
        Login
    </a>

</div>


<div class="footer-copy">

    © {{ date('Y') }}

    <br>

    Sistem Informasi Ruang Kreasi

    <br>

    Dinas Kebudayaan dan Pariwisata

    <br>

    Kabupaten Cirebon

</div>

@endsection