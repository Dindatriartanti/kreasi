<?php

namespace App\Http\Controllers;

use App\Models\Kontributor;
use App\Models\Karya;
use App\Models\RatingKontributor;
use App\Models\KategoriKontributor;
use Illuminate\Http\Request;

class KontributorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Kontributor
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $kategori = $request->kategori;

        $kontributors = Kontributor::query()

            ->withCount([
                'karyaPublish'
            ])

            ->where('status', 'aktif')

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'nama_kontributor',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'deskripsi',
                        'like',
                        "%{$search}%"
                    );

                });

            })

            ->when($kategori, function ($query) use ($kategori) {

                $query->whereHas(
                    'karyaPublish.kategoriKontributor',
                    function ($q) use ($kategori) {

                        $q->where(
                            'slug',
                            $kategori
                        );

                    }
                );

            })

            ->orderBy('nama_kontributor')

            ->paginate(12)

            ->withQueryString();

        $kategoriKontributor = KategoriKontributor::where(
                'status',
                'aktif'
            )
            ->orderBy('nama_kategori')
            ->get();

        return view(
            'guest.kontributor.index',
            [

                'title' => 'Kontributor',

                'search' => $search,

                'kategori' => $kategori,

                'kategoriKontributor' => $kategoriKontributor,

                'kontributors' => $kontributors,

            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Detail Kontributor
    |--------------------------------------------------------------------------
    */

    public function show(Kontributor $kontributor)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Kontributor
        |--------------------------------------------------------------------------
        */

        abort_if(
            $kontributor->status != 'aktif',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Load Relasi
        |--------------------------------------------------------------------------
        */

        $kontributor->load([
            'rating.user',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Karya yang Dipublikasikan
        |--------------------------------------------------------------------------
        */

        $karya = $kontributor->karyaPublish()
            ->with([
                'kategoriKontributor'
            ])
            ->latest('tanggal_upload')
            ->paginate(12);


        /*
        |--------------------------------------------------------------------------
        | Rating Rata-rata
        |--------------------------------------------------------------------------
        */

        $ratingRataRata = $kontributor->rating()
            ->where(
                'status',
                'tampil'
            )
            ->avg('rating');


        /*
        |--------------------------------------------------------------------------
        | Jumlah Rating
        |--------------------------------------------------------------------------
        */

        $jumlahRating = $kontributor->rating()
            ->where(
                'status',
                'tampil'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Daftar Rating & Komentar
        |--------------------------------------------------------------------------
        */

        $rating = $kontributor->rating()
            ->with('user')
            ->where(
                'status',
                'tampil'
            )
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'guest.kontributor.show',
            [

                'title' => $kontributor->nama_kontributor,

                'kontributor' => $kontributor,

                'karya' => $karya,

                'ratingRataRata' => $ratingRataRata,

                'jumlahRating' => $jumlahRating,

                'rating' => $rating,

            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Detail Karya
    |--------------------------------------------------------------------------
    */

    public function karya(
        Kontributor $kontributor,
        Karya $karya
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validasi Kontributor
        |--------------------------------------------------------------------------
        */

        abort_if(
            $kontributor->status != 'aktif',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi Karya
        |--------------------------------------------------------------------------
        */

        abort_if(
            $karya->status != 'publish',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Pastikan Karya Milik Kontributor
        |--------------------------------------------------------------------------
        */

        abort_if(
            $karya->id_kontributor != $kontributor->id_kontributor,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Load Relasi
        |--------------------------------------------------------------------------
        */

        $karya->load([

            'kontributor',

            'kategoriKontributor',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Karya Lainnya
        |--------------------------------------------------------------------------
        */

        $karyaLainnya = Karya::with([

                'kategoriKontributor',

            ])
            ->where(
                'id_kontributor',
                $kontributor->id_kontributor
            )
            ->where(
                'status',
                'publish'
            )
            ->where(
                'id_karya',
                '!=',
                $karya->id_karya
            )
            ->latest('tanggal_upload')
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'guest.kontributor.karya.show',
            [

                'title' => $karya->judul_karya,

                'kontributor' => $kontributor,

                'karya' => $karya,

                'karyaLainnya' => $karyaLainnya,

            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Semua Karya Kontributor
    |--------------------------------------------------------------------------
    */

    public function karyaIndex(
        Request $request,
        Kontributor $kontributor
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validasi Kontributor
        |--------------------------------------------------------------------------
        */

        abort_if(
            $kontributor->status != 'aktif',
            404
        );


        $search = $request->search;

        $kategori = $request->kategori;


        /*
        |--------------------------------------------------------------------------
        | Semua Karya Publish
        |--------------------------------------------------------------------------
        */

        $karya = Karya::with([
                'kategoriKontributor'
            ])
            ->where(
                'id_kontributor',
                $kontributor->id_kontributor
            )
            ->where(
                'status',
                'publish'
            )

            ->when($search, function ($query) use ($search) {

                $query->where(
                    'judul_karya',
                    'like',
                    "%{$search}%"
                );

            })

            ->when($kategori, function ($query) use ($kategori) {

                $query->whereHas(
                    'kategoriKontributor',
                    function ($q) use ($kategori) {

                        $q->where(
                            'slug',
                            $kategori
                        );

                    }
                );

            })

            ->latest('tanggal_upload')

            ->paginate(12)

            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Kategori Kontributor
        |--------------------------------------------------------------------------
        */

        $kategoriKontributor = KategoriKontributor::where(
                'status',
                'aktif'
            )
            ->orderBy('nama_kategori')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'guest.kontributor.karya.index',
            [

                'title' => 'Karya ' . $kontributor->nama_kontributor,

                'kontributor' => $kontributor,

                'karya' => $karya,

                'search' => $search,

                'kategori' => $kategori,

                'kategoriKontributor' => $kategoriKontributor,

            ]
        );
    }
}