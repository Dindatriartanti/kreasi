<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

use App\Models\Karya;
use App\Models\Pengaduan;
use App\Models\PendaftaranKunjungan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('admin.components.navbar', function ($view) {

            $notifications = collect();

            /*
            |--------------------------------------------------------------------------
            | Karya Review
            |--------------------------------------------------------------------------
            */

            $karya = Karya::with('kontributor')
                ->where('status', 'review')
                ->latest()
                ->get();

            foreach ($karya as $item) {

                $notifications->push([

                    'title' => 'Karya Baru',

                    'message' => ($item->kontributor->nama_kontributor ?? '-')
                        . ' mengajukan karya "' . $item->judul_karya . '"',

                    'icon' => 'bi-images',

                    'color' => 'text-primary',

                    'url' => route('admin.karya.index'),

                    'created_at' => $item->updated_at ?? $item->created_at,

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | Booking
            |--------------------------------------------------------------------------
            */

            $booking = PendaftaranKunjungan::where('status', 'menunggu')
                ->latest()
                ->get();

            foreach ($booking as $item) {

                $notifications->push([

                    'title' => 'Booking Baru',

                    'message' => 'Booking dari '
                        . ($item->nama ?? 'Pengunjung'),

                    'icon' => 'bi-calendar-check',

                    'color' => 'text-success',

                    'url' => route('admin.booking.index'),

                    'created_at' => $item->created_at,

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | Pengaduan
            |--------------------------------------------------------------------------
            */

            $pengaduan = Pengaduan::where('is_read', false)
                ->latest()
                ->get();

            foreach ($pengaduan as $item) {

                $notifications->push([

                    'title' => 'Pengaduan Baru',

                    'message' => 'Pengaduan dari '
                        . ($item->nama ?? 'Masyarakat'),

                    'icon' => 'bi-chat-left-text',

                    'color' => 'text-danger',

                    'url' => route('admin.pengaduan.index'),

                    'created_at' => $item->created_at,

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | Urutkan terbaru
            |--------------------------------------------------------------------------
            */

            $notifications = $notifications
                ->sortByDesc('created_at')
                ->values();

            $view->with([

                'notifications' => $notifications,

                'totalNotif' => $notifications->count(),

            ]);

        });
    }
}