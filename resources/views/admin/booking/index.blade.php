@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0">
            {{ $title }}
        </h4>

        <small class="text-muted">
            Kelola data pendaftaran kunjungan.
        </small>

    </div>

</div>


<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <form method="GET">

            <div class="row">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama, No HP, email, instansi atau tujuan">

                </div>

                <div class="col-auto">

                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            No HP
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Instansi
                        </th>

                        <th>
                            Tujuan
                        </th>

                        <th>
                            Jumlah
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Status
                        </th>

                        <th width="170">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($booking as $item)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($booking->firstItem() - 1) }}

                        </td>


                        <td>

                            <strong>
                                {{ $item->nama_pemesan }}
                            </strong>

                        </td>


                        <td>

                            @if($item->no_hp)

                                <a
                                    href="tel:{{ $item->no_hp }}"
                                    class="text-decoration-none">

                                    <i class="bi bi-telephone me-1"></i>

                                    {{ $item->no_hp }}

                                </a>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($item->email)

                                <a
                                    href="mailto:{{ $item->email }}"
                                    class="text-decoration-none">

                                    <i class="bi bi-envelope me-1"></i>

                                    {{ $item->email }}

                                </a>

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>


                        <td>

                            {{ $item->instansi }}

                        </td>


                        <td>

                            {{ $item->tujuan }}

                        </td>


                        <td>

                            <strong>
                                {{ $item->dewasa }}
                            </strong>

                            Dewasa

                            <br>

                            <small class="text-muted">

                                {{ $item->anak }}

                                Anak

                            </small>

                        </td>


                        <td>

                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}

                        </td>


                        <td>

                            @switch($item->status)

                                @case('menunggu')

                                    <span class="badge bg-warning text-dark">

                                        Menunggu

                                    </span>

                                @break


                                @case('disetujui')

                                    <span class="badge bg-success">

                                        Disetujui

                                    </span>

                                @break


                                @case('ditolak')

                                    <span class="badge bg-danger">

                                        Ditolak

                                    </span>

                                @break


                                @case('selesai')

                                    <span class="badge bg-secondary">

                                        Selesai

                                    </span>

                                @break

                                @default

                                    <span class="badge bg-dark">

                                        {{ $item->status }}

                                    </span>

                            @endswitch

                        </td>


                        <td>

                            <a
                                href="{{ route('admin.booking.edit', $item) }}"
                                class="btn btn-warning btn-sm"
                                title="Edit">

                                <i class="bi bi-pencil"></i>

                            </a>


                            @if($item->status === 'disetujui')

                                <a
                                    href="{{ route('admin.booking.kode-booking', $item) }}"
                                    class="btn btn-success btn-sm"
                                    title="Kode Booking">

                                    <i class="bi bi-ticket-perforated"></i>

                                </a>

                            @endif


                            <form
                                action="{{ route('admin.booking.destroy', $item) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Hapus data booking?')"
                                    class="btn btn-danger btn-sm"
                                    title="Hapus">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5">

                            <i class="bi bi-calendar-x display-5 text-muted"></i>

                            <p class="mt-3 mb-0 text-muted">

                                Tidak ada data pendaftaran kunjungan.

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="card-footer bg-white">

        {{ $booking->links() }}

    </div>

</div>

@endsection