<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Karya;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Koleksi;
use App\Models\Pengaduan;
use App\Models\Kontributor;
use App\Models\KategoriKontributor;
use App\Models\PendaftaranKunjungan;

class DashboardController extends AdminController
{
    protected string $title = 'Dashboard';

    public function index()
    {
        return view('admin.dashboard.index', $this->pageData([

            // Ringkasan
            'totalUser' => User::count(),
            'totalKontributor' => Kontributor::count(),
            'totalKategori' => Kategori::count(),
            'totalKategoriKontributor' => KategoriKontributor::count(),
            'totalKoleksi' => Koleksi::count(),
            'totalKegiatan' => Kegiatan::count(),
            'totalKarya' => Karya::count(),
            'totalPengaduan' => Pengaduan::count(),
            'totalBooking' => PendaftaranKunjungan::count(),

            // Status Karya
            'karyaReview' => Karya::where('status', 'review')->count(),
            'karyaPublish' => Karya::where('status', 'publish')->count(),
            'karyaDitolak' => Karya::where('status', 'ditolak')->count(),

            // Status Booking
            'bookingMenunggu' => PendaftaranKunjungan::where('status', 'menunggu')->count(),
            'bookingDisetujui' => PendaftaranKunjungan::where('status', 'disetujui')->count(),
            'bookingDitolak' => PendaftaranKunjungan::where('status', 'ditolak')->count(),
            'bookingSelesai' => PendaftaranKunjungan::where('status', 'selesai')->count(),

            // Status Kegiatan
            'kegiatanDraft' => Kegiatan::where('status', 'draft')->count(),
            'kegiatanPublish' => Kegiatan::where('status', 'publish')->count(),
            'kegiatanSelesai' => Kegiatan::where('status', 'selesai')->count(),

            // Status Pengaduan
            'pengaduanBelumDibaca' => Pengaduan::where('is_read', false)->count(),
            'pengaduanSudahDibaca' => Pengaduan::where('is_read', true)->count(),

            // Aktivitas Terbaru
            'latestUsers' => User::latest()->take(5)->get(),

            'latestKarya' => Karya::with([
                'kontributor',
                'kategoriKontributor'
            ])->latest()->take(5)->get(),

            'latestBooking' => PendaftaranKunjungan::latest()->take(5)->get(),

            'latestPengaduan' => Pengaduan::latest()->take(5)->get(),

            'latestKegiatan' => Kegiatan::latest()->take(5)->get(),

            'latestKoleksi' => Koleksi::latest()->take(5)->get(),

        ]));
    }
}