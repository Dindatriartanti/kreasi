@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">{{ $title }}</h4>

            <small class="text-muted">

                Kelola data koleksi pada sistem.

            </small>

        </div>

        <a href="{{ route('admin.koleksi.create') }}" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Koleksi

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <form action="{{ route('admin.koleksi.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <div class="input-group">

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari nama koleksi..."
                                value="{{ request('search') }}">

                            <button class="btn btn-primary">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th width="90">Gambar</th>

                            <th>Nama Koleksi</th>

                            <th>Kategori</th>

                            <th>Lokasi</th>

                            <th>Status</th>

                            <th width="150" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($koleksi as $item)

                        <tr>

                            <td>

                                {{ $koleksi->firstItem() + $loop->index }}

                            </td>

                            <td>

                                @if($item->gambar)

                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         width="60"
                                         height="60"
                                         class="rounded border object-fit-cover">

                                @else

                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                         style="width:60px;height:60px">

                                        <i class="bi bi-image text-secondary"></i>

                                    </div>

                                @endif

                            </td>

                            <td>

                                <strong>

                                    {{ $item->nama_koleksi }}

                                </strong>

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $item->kategori->nama_kategori }}

                                </span>

                            </td>

                            <td>

                                {{ $item->lokasi ?? '-' }}

                            </td>

                            <td>

                                @if($item->status=='dipamerkan')

                                    <span class="badge bg-success">

                                        Dipamerkan

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Disimpan

                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <a href="{{ route('admin.koleksi.edit',$item->id_koleksi) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('admin.koleksi.destroy',$item->id_koleksi) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-inbox display-6 d-block mb-2"></i>

                                Belum ada data koleksi.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            {{ $koleksi->links() }}

        </div>

    </div>

</div>

@endsection