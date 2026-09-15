<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranKunjungan;
use Illuminate\Http\Request;

class PendaftaranKunjunganController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | WEBSITE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('guest.kontak', [
            'title' => 'Kontak Kami'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nama_pemesan' => 'required|string|max:150',

            'no_hp' => 'required|string|max:30',

            'email' => 'required|email|max:150',

            'instansi' => 'required|string|max:255',

            'tujuan' => 'required|string|max:255',

            'dewasa' => 'required|integer|min:0',

            'anak' => 'required|integer|min:0',

            'tanggal' => 'required|date',

        ]);

        $validated['status'] = 'menunggu';

        PendaftaranKunjungan::create($validated);

        return redirect()
            ->back()
            ->with(
                'success',
                'Booking kunjungan berhasil dikirim. Mohon menunggu konfirmasi dari admin.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $booking = PendaftaranKunjungan::when(
                $search,
                function ($query) use ($search) {

                    $query->where(function ($q) use ($search) {

                        $q->where(
                            'nama_pemesan',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'no_hp',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'instansi',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'tujuan',
                            'like',
                            "%{$search}%"
                        );

                    });

                }
            )

            ->latest('created_at')

            ->paginate(10)

            ->withQueryString();

        return view('admin.booking.index', [

            'title' => 'Data Booking',

            'booking' => $booking,

            'search' => $search,

        ]);
    }

    public function show(PendaftaranKunjungan $booking)
    {
        return view('admin.booking.show', [

            'title' => 'Detail Booking',

            'booking' => $booking,

        ]);
    }

    public function edit(PendaftaranKunjungan $booking)
    {
        return view('admin.booking.edit', [

            'title' => 'Edit Booking',

            'booking' => $booking,

        ]);
    }

    public function update(
        Request $request,
        PendaftaranKunjungan $booking
    ) {

        $validated = $request->validate([

            'status' => [
                'required',
                'in:menunggu,disetujui,ditolak,selesai'
            ],

        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.booking.index')
            ->with(
                'success',
                'Status booking berhasil diperbarui.'
            );
    }

    public function kodeBooking(PendaftaranKunjungan $booking)
    {
        if ($booking->status !== 'disetujui') {

            return redirect()
                ->route('admin.booking.index')
                ->with(
                    'error',
                    'Kode booking hanya tersedia untuk pendaftaran yang telah disetujui.'
                );
        }

        return view('admin.booking.kode-booking', [

            'title' => 'Kode Booking',

            'booking' => $booking,

        ]);
    }

    public function destroy(PendaftaranKunjungan $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.booking.index')
            ->with(
                'success',
                'Data booking berhasil dihapus.'
            );
    }
}