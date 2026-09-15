<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingKontributor;
use Illuminate\Http\Request;

class RatingKontributorController extends Controller
{
    public function index(Request $request)
    {
        if (
            auth()->user()->role !== 'admin'
        ) {
            abort(403);
        }

        $search = $request->search;

        $status = $request->status;


        $rating = RatingKontributor::with([
                'kontributor',
                'user',
            ])
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(function ($q) use ($search) {

                        $q->whereHas(
                            'kontributor',
                            function ($kontributor) use ($search) {

                                $kontributor
                                    ->where(
                                        'nama_kontributor',
                                        'like',
                                        "%{$search}%"
                                    );

                            }
                        )

                        ->orWhereHas(
                            'user',
                            function ($user) use ($search) {

                                $user
                                    ->where(
                                        'name',
                                        'like',
                                        "%{$search}%"
                                    );

                            }
                        )

                        ->orWhere(
                            'komentar',
                            'like',
                            "%{$search}%"
                        );

                    });

                }
            )
            ->when(
                $status,
                function ($query) use ($status) {

                    $query->where(
                        'status',
                        $status
                    );

                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $totalRating = RatingKontributor::count();

        $ratingTampil = RatingKontributor::where(
            'status',
            'tampil'
        )->count();

        $ratingDisembunyikan = RatingKontributor::where(
            'status',
            'disembunyikan'
        )->count();


        return view(
            'admin.rating.index',
            [
                'title' => 'Rating Kontributor',

                'rating' => $rating,

                'search' => $search,

                'status' => $status,

                'totalRating' => $totalRating,

                'ratingTampil' => $ratingTampil,

                'ratingDisembunyikan' =>
                    $ratingDisembunyikan,
            ]
        );
    }


    public function update(
        Request $request,
        RatingKontributor $rating
    ) {
        if (
            auth()->user()->role !== 'admin'
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'in:tampil,disembunyikan',
            ],
        ]);

        $rating->update($validated);

        return redirect()
            ->route('admin.rating.index')
            ->with(
                'success',
                'Status rating berhasil diperbarui.'
            );
    }


    public function destroy(
        RatingKontributor $rating
    ) {
        if (
            auth()->user()->role !== 'admin'
        ) {
            abort(403);
        }

        $rating->delete();

        return redirect()
            ->route('admin.rating.index')
            ->with(
                'success',
                'Rating berhasil dihapus.'
            );
    }
}