@extends('layouts.auth')

@section('content')

<div class="text-center mb-4">

    <img src="{{ asset('assets/logo/logo.jpg') }}"
         alt="Logo"
         class="mb-3"
         style="width:80px;">

    <h2 class="auth-title">
        Selamat Datang
    </h2>

    <p class="auth-subtitle">
        Silakan login untuk mengakses Sistem Informasi Ruang Kreasi.
    </p>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

<form action="{{ route('login') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label class="form-label">

            Username

        </label>

        <div class="input-group">

            <span class="input-group-text">

                <i class="bi bi-person"></i>

            </span>

            <input
                type="text"
                name="username"
                class="form-control @error('username') is-invalid @enderror"
                placeholder="Masukkan username"
                value="{{ old('username') }}"
                autofocus>

        </div>

        @error('username')

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

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember">

            <label class="form-check-label" for="remember">

                Ingat Saya

            </label>

        </div>

    </div>

    <button
        type="submit"
        class="btn btn-primary btn-login w-100">

        <i class="bi bi-box-arrow-in-right me-2"></i>

        LOGIN

    </button>

</form>

<div class="auth-footer">

    Belum memiliki akun?

    <a href="{{ route('register') }}">

        Daftar Sekarang

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