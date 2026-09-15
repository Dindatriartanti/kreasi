<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Daftar kegiatan.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $kegiatan = Kegiatan::when($search, function ($query) use ($search) {

                $query->where('nama_kegiatan', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%");

            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('guest.kegiatan.index', [
            'title'     => 'Kegiatan',
            'kegiatan'  => $kegiatan,
            'search'    => $search,
        ]);
    }

    /**
     * Detail kegiatan.
     */
    public function show(Kegiatan $kegiatan)
    {
        $related = Kegiatan::where('id_kegiatan', '!=', $kegiatan->id_kegiatan)
            ->latest()
            ->take(3)
            ->get();

        return view('guest.kegiatan.show', [
            'title'     => $kegiatan->nama_kegiatan,
            'kegiatan'  => $kegiatan,
            'related'   => $related,
        ]);
    }
}