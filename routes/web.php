<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| WEBSITE CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\KontributorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RatingKontributorController;
use App\Http\Controllers\KontributorRatingController;

/*
|--------------------------------------------------------------------------
| GLOBAL CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\KontakController;
use App\Http\Controllers\PendaftaranKunjunganController;
use App\Http\Controllers\PengaduanController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKontributorController;
use App\Http\Controllers\Admin\KoleksiController as AdminKoleksiController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\KontributorController as AdminKontributorController;
use App\Http\Controllers\Admin\KaryaController as AdminKaryaController;
use App\Http\Controllers\Admin\RatingKontributorController as AdminRatingKontributorController;

/*
|--------------------------------------------------------------------------
| KONTRIBUTOR CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Kontributor\DashboardController as KontributorDashboardController;
use App\Http\Controllers\Kontributor\ProfilController;
use App\Http\Controllers\Kontributor\KaryaController as KontributorKaryaController;


/*
|--------------------------------------------------------------------------
| WEBSITE (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('guest.home');

Route::view('/tentang', 'guest.tentang')
    ->name('guest.tentang');


/*
|--------------------------------------------------------------------------
| GALLERY
|--------------------------------------------------------------------------
*/

Route::get(
    '/gallery',
    [GalleryController::class, 'index']
)->name('guest.gallery');

Route::prefix('gallery')
    ->name('guest.gallery.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Museum
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/museum',
            [KoleksiController::class, 'index']
        )->name('museum.index');

        Route::get(
            '/museum/{koleksi:slug}',
            [KoleksiController::class, 'show']
        )->name('museum.show');


        /*
        |--------------------------------------------------------------------------
        | Kontributor
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kontributor',
            [KontributorController::class, 'index']
        )->name('kontributor.index');


        /*
        |--------------------------------------------------------------------------
        | Rating Kontributor
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/kontributor/{kontributor:slug}/rating',
            [RatingKontributorController::class, 'store']
        )
            ->name('kontributor.rating.store');


        /*
        |--------------------------------------------------------------------------
        | Profil Kontributor
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kontributor/{kontributor:slug}',
            [KontributorController::class, 'show']
        )->name('kontributor.show');


        /*
        |--------------------------------------------------------------------------
        | Semua Karya Kontributor
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kontributor/{kontributor:slug}/karya',
            [KontributorController::class, 'karyaIndex']
        )->name('kontributor.karya.index');


        /*
        |--------------------------------------------------------------------------
        | Detail Karya
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/kontributor/{kontributor:slug}/karya/{karya:slug}',
            [KontributorController::class, 'karya']
        )->name('kontributor.karya.show');

    });


/*
|--------------------------------------------------------------------------
| WEBSITE - KEGIATAN
|--------------------------------------------------------------------------
*/

Route::get(
    '/kegiatan',
    [KegiatanController::class, 'index']
)->name('guest.kegiatan.index');

Route::get(
    '/kegiatan/{kegiatan:slug}',
    [KegiatanController::class, 'show']
)->name('guest.kegiatan.show');


/*
|--------------------------------------------------------------------------
| WEBSITE - KONTAK
|--------------------------------------------------------------------------
*/

Route::get(
    '/kontak',
    [KontakController::class, 'index']
)->name('guest.kontak');


/*
|--------------------------------------------------------------------------
| BOOKING & PENGADUAN
|--------------------------------------------------------------------------
*/

Route::post(
    '/booking',
    [PendaftaranKunjunganController::class, 'store']
)->name('guest.booking.store');

Route::post(
    '/pengaduan',
    [PengaduanController::class, 'store']
)->name('guest.pengaduan.store');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/login',
        [LoginController::class, 'showLoginForm']
    )->name('login');

    Route::post(
        '/login',
        [LoginController::class, 'login']
    );

    Route::get(
        '/register',
        [RegisterController::class, 'showRegistrationForm']
    )->name('register');

    Route::post(
        '/register',
        [RegisterController::class, 'register']
    );

});


Route::post(
    '/logout',
    [LoginController::class, 'logout']
)
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'user',
            UserController::class
        );

        Route::resource(
            'kategori',
            KategoriController::class
        );

        Route::resource(
            'kategori-kontributor',
            KategoriKontributorController::class
        );


        /*
        |--------------------------------------------------------------------------
        | KOLEKSI MUSEUM
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'koleksi',
            AdminKoleksiController::class
        );


        /*
        |--------------------------------------------------------------------------
        | KEGIATAN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'kegiatan',
            AdminKegiatanController::class
        );


        /*
        |--------------------------------------------------------------------------
        | KONTRIBUTOR
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'kontributor',
            AdminKontributorController::class
        )->only([
            'index',
            'show',
            'edit',
            'update',
        ]);


        /*
        |--------------------------------------------------------------------------
        | RATING KONTRIBUTOR
        |--------------------------------------------------------------------------
        */

        Route::prefix('rating')
            ->name('rating.')
            ->group(function () {

                Route::get(
                    '/',
                    [AdminRatingKontributorController::class, 'index']
                )->name('index');

                Route::put(
                    '/{rating}',
                    [AdminRatingKontributorController::class, 'update']
                )->name('update');

                Route::delete(
                    '/{rating}',
                    [AdminRatingKontributorController::class, 'destroy']
                )->name('destroy');

            });


        /*
        |--------------------------------------------------------------------------
        | MODERASI KARYA
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'karya',
            AdminKaryaController::class
        )->only([
            'index',
            'show',
            'edit',
            'update',
            'destroy',
        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOKING KUNJUNGAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('booking')
            ->name('booking.')
            ->group(function () {

                Route::get(
                    '/',
                    [PendaftaranKunjunganController::class, 'index']
                )->name('index');

                Route::get(
                    '/{booking}/edit',
                    [PendaftaranKunjunganController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/{booking}',
                    [PendaftaranKunjunganController::class, 'update']
                )->name('update');

                Route::delete(
                    '/{booking}',
                    [PendaftaranKunjunganController::class, 'destroy']
                )->name('destroy');

                Route::get(
                    '/{booking}/kode-booking',
                    [PendaftaranKunjunganController::class, 'kodeBooking']
                )->name('kode-booking');

                Route::get(
                    '/{booking}',
                    [PendaftaranKunjunganController::class, 'show']
                )->name('show');

            });


        /*
        |--------------------------------------------------------------------------
        | PENGADUAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('pengaduan')
            ->name('pengaduan.')
            ->group(function () {

                Route::get(
                    '/',
                    [PengaduanController::class, 'index']
                )->name('index');

                Route::get(
                    '/{pengaduan}/edit',
                    [PengaduanController::class, 'edit']
                )->name('edit');

                Route::put(
                    '/{pengaduan}',
                    [PengaduanController::class, 'update']
                )->name('update');

                Route::delete(
                    '/{pengaduan}',
                    [PengaduanController::class, 'destroy']
                )->name('destroy');

                Route::get(
                    '/{pengaduan}',
                    [PengaduanController::class, 'show']
                )->name('show');

            });

    });


/*
|--------------------------------------------------------------------------
| KONTRIBUTOR
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('kontributor')
    ->name('kontributor.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [KontributorDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Profil
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profil',
            [ProfilController::class, 'show']
        )->name('profil.show');

        Route::get(
            '/profil/edit',
            [ProfilController::class, 'edit']
        )->name('profil.edit');

        Route::put(
            '/profil',
            [ProfilController::class, 'update']
        )->name('profil.update');


        /*
        |--------------------------------------------------------------------------
        | Rating & Komentar
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/rating',
            [KontributorRatingController::class, 'index']
        )->name('rating.index');


        /*
        |--------------------------------------------------------------------------
        | Karya Saya
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/karya',
            [KontributorKaryaController::class, 'index']
        )->name('karya.index');

        Route::get(
            '/karya/create',
            [KontributorKaryaController::class, 'create']
        )->name('karya.create');

        Route::post(
            '/karya',
            [KontributorKaryaController::class, 'store']
        )->name('karya.store');


        /*
        |--------------------------------------------------------------------------
        | Sedang Diajukan
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/karya/review',
            [KontributorKaryaController::class, 'review']
        )->name('karya.review');


        /*
        |--------------------------------------------------------------------------
        | Detail Karya
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/karya/{karya}',
            [KontributorKaryaController::class, 'show']
        )->name('karya.show');


        /*
        |--------------------------------------------------------------------------
        | Edit Karya
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/karya/{karya}/edit',
            [KontributorKaryaController::class, 'edit']
        )->name('karya.edit');

        Route::put(
            '/karya/{karya}',
            [KontributorKaryaController::class, 'update']
        )->name('karya.update');


        /*
        |--------------------------------------------------------------------------
        | Hapus Karya
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/karya/{karya}',
            [KontributorKaryaController::class, 'destroy']
        )->name('karya.destroy');

    });