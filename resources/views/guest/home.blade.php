@extends('layouts.app')

@push('styles')
    @vite('resources/css/home.css')
@endpush

@section('content')

    {{-- HERO --}}
    @include('guest.components.home.hero')

    {{-- KILAS KONTRIBUTOR & KARYA --}}
    @include('guest.components.home.contributor')

    {{-- KILAS KOLEKSI --}}
    @include('guest.components.home.koleksi')

    {{-- KILAS KEGIATAN --}}
    @include('guest.components.home.kegiatan')

    {{-- LOKASI --}}
    @include('guest.components.home.lokasi')

@endsection