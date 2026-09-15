@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h4 class="mb-0">

                Tambah Kategori

            </h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.kategori.store') }}"
                  method="POST">

                @csrf

                @include('admin.kategori.form')

            </form>

        </div>

    </div>

</div>

@endsection