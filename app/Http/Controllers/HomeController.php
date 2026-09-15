<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use App\Models\Kontributor;
use App\Models\Kegiatan;
use App\Models\Koleksi;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | KILAS KARYA
        |--------------------------------------------------------------------------
        */

        $karyaTerbaru = Karya::with([
                'kontributor',
                'kategoriKontributor',
            ])
            ->where('status', 'publish')
            ->latest('tanggal_upload')
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KILAS KONTRIBUTOR
        |--------------------------------------------------------------------------
        */

        $kontributorTerbaru = Kontributor::withCount([
                'karyaPublish'
            ])
            ->where('status', 'aktif')
            ->orderBy('nama_kontributor')
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KILAS KEGIATAN
        |--------------------------------------------------------------------------
        */

        $kegiatanTerbaru = Kegiatan::query()
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KILAS KOLEKSI
        |--------------------------------------------------------------------------
        */

        $koleksiTerbaru = Koleksi::query()
            ->latest()
            ->take(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $jumlahKontributor = Kontributor::where(
            'status',
            'aktif'
        )->count();

        $jumlahKarya = Karya::where(
            'status',
            'publish'
        )->count();

        $jumlahSubsektor = Kategori::where(
            'status',
            'aktif'
        )->count();

        $jumlahKoleksi = Koleksi::count();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('guest.home', [

            'title' => 'Ruang Kreasi',

            'karyaTerbaru' => $karyaTerbaru,

            'kontributorTerbaru' => $kontributorTerbaru,

            'kegiatanTerbaru' => $kegiatanTerbaru,

            'koleksiTerbaru' => $koleksiTerbaru,

            'jumlahKontributor' => $jumlahKontributor,

            'jumlahKarya' => $jumlahKarya,

            'jumlahSubsektor' => $jumlahSubsektor,

            'jumlahKoleksi' => $jumlahKoleksi,

        ]);
    }
}