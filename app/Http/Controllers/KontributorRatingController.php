<?php

namespace App\Http\Controllers;

use App\Models\Kontributor;
use Illuminate\Support\Facades\Auth;

class KontributorRatingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'kontributor') {
            abort(403);
        }

        $kontributor = Kontributor::where(
            'id_user',
            $user->id
        )->firstOrFail();

        $rating = $kontributor->rating()
            ->with('user')
            ->where('status', 'tampil')
            ->latest()
            ->paginate(10);

        $ratingRataRata = $kontributor->rating()
            ->where('status', 'tampil')
            ->avg('rating');

        $jumlahRating = $kontributor->rating()
            ->where('status', 'tampil')
            ->count();

        return view(
            'kontributor.rating.index',
            [
                'title' => 'Rating & Komentar',

                'kontributor' => $kontributor,

                'rating' => $rating,

                'ratingRataRata' => $ratingRataRata,

                'jumlahRating' => $jumlahRating,
            ]
        );
    }
}