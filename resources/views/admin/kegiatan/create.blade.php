@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <form action="{{ route('admin.kegiatan.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('admin.kegiatan.form')

    </form>

</div>

@endsection