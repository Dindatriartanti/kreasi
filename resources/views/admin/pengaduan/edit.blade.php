@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="mb-0">

                {{ $title }}

            </h5>

        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.pengaduan.update',$pengaduan) }}"
                method="POST">

                @csrf
                @method('PUT')

                @include('admin.pengaduan.form')

            </form>

        </div>

    </div>

</div>

@endsection