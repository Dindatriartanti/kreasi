@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h4 class="mb-0">Tambah User</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.user.store') }}"
                  method="POST">

                @csrf

                @include('admin.user.form')

            </form>

        </div>

    </div>

</div>

@endsection