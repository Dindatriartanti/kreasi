@extends('layouts.admin')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            {{ $title }}
        </h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.kegiatan.update', $kegiatan) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')

            @include('admin.kegiatan.form')

        </form>

    </div>

</div>

@endsection