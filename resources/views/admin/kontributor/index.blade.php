@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <h5 class="mb-0">

                {{ $title }}

                <span class="badge bg-primary ms-1">

                    {{ $kontributors->total() }}

                </span>

            </h5>

            <form method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama atau email..."
                        value="{{ $search }}">

                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="80">Foto</th>

                        <th>Kontributor</th>

                        <th>Email</th>

                        <th>No HP</th>

                        <th>Status</th>

                        <th class="text-center" width="100">Bukti</th>

                        <th class="text-center" width="120">Karya</th>

                        <th class="text-center" width="140">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($kontributors as $kontributor)

                        <tr>

                            <td>

                                <img
                                    src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                                    class="rounded-circle border"
                                    width="55"
                                    height="55"
                                    style="object-fit: cover;">

                            </td>

                            <td>

                                <a
                                    href="{{ route('admin.kontributor.show', $kontributor) }}"
                                    class="fw-semibold text-decoration-none">

                                    {{ $kontributor->nama_kontributor }}

                                </a>

                                <div class="small text-muted">

                                    {{ '@'.$kontributor->user->username }}

                                </div>

                                <div class="small text-secondary">

                                    {{ $kontributor->slug }}

                                </div>

                            </td>

                            <td>

                                {{ $kontributor->email }}

                            </td>

                            <td>

                                {{ $kontributor->no_hp }}

                            </td>

                            <td>

                                @if($kontributor->status == 'aktif')

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Nonaktif

                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                @if($kontributor->bukti_karya)
                                    <a
                                        href="{{ asset('storage/' . $kontributor->bukti_karya) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="btn btn-outline-success btn-sm"
                                        title="Lihat Bukti Karya">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </a>
                                @else
                                    <span
                                        class="badge bg-secondary"
                                        title="Belum ada bukti karya">
                                        <i class="bi bi-file-earmark-x"></i>
                                    </span>
                                @endif

                            </td>

                            <td class="text-center">

                                <span class="badge bg-primary">

                                    {{ $kontributor->karya_count }}

                                </span>

                            </td>

                            <td class="text-center">

                                <a
                                    href="{{ route('admin.kontributor.show', $kontributor) }}"
                                    class="btn btn-info btn-sm"
                                    title="Detail">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a
                                    href="{{ route('admin.kontributor.edit', $kontributor) }}"
                                    class="btn btn-warning btn-sm"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="bi bi-people fs-1 text-secondary"></i>

                                <div class="mt-2">

                                    Data kontributor tidak ditemukan.

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($kontributors->hasPages())

        <div class="card-footer bg-white">

            {{ $kontributors->links() }}

        </div>

    @endif

</div>

@endsection