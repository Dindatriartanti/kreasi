@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <form action="{{ route('admin.koleksi.update',$koleksi->id_koleksi) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.koleksi.form')

    </form>

</div>

@endsection