<?php

namespace App\Http\Controllers;

use App\Models\Kontributor;
use App\Models\RatingKontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingKontributorController extends Controller
{
    public function store(
        Request $request,
        Kontributor $kontributor
    ) {
        $validated = $request->validate([
            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],
            'komentar' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        RatingKontributor::create([
            'id_kontributor' => $kontributor->id_kontributor,

            // NULL jika pengunjung belum login
            'id_user' => Auth::id(),

            'rating' => $validated['rating'],

            'komentar' => $validated['komentar'] ?? null,

            'status' => 'tampil',
        ]);

        return redirect()
            ->route(
                'guest.gallery.kontributor.show',
                $kontributor->slug
            )
            ->with(
                'success',
                'Rating dan komentar berhasil dikirim.'
            );
    }
}