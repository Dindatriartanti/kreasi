<?php

namespace App\Http\Controllers\Kontributor;

use App\Http\Controllers\Controller;
use App\Models\Kontributor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $kontributor = Kontributor::with([
            'karya' => function ($query) {
                $query->latest('tanggal_upload')
                    ->take(10);
            }
        ])
        ->where('id_user', Auth::id())
        ->firstOrFail();

        return view('kontributor.dashboard.index', [

            'title' => 'Dashboard',

            'kontributor' => $kontributor,

            'totalKarya' => $kontributor->karya()->count(),

            'publish' => $kontributor->karyaPublish()->count(),

            'review' => $kontributor->karyaReview()->count(),

            'ditolak' => $kontributor->karyaDitolak()->count(),

            'kilasKarya' => $kontributor->karya

        ]);
    }
}