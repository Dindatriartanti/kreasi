@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <form action="{{ route('admin.koleksi.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @include('admin.koleksi.form')

    </form>

</div>

@endsection