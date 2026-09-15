<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\PendaftaranKunjungan;
use App\Models\Pengaduan;

class AdminController extends Controller
{
    protected string $title = '';

    protected function pageData(array $data = [])
    {
        return array_merge([
            'title' => $this->title,

            // Badge Sidebar
            'pendingKarya' => Karya::where('status', 'review')->count(),
            'pendingBooking' => PendaftaranKunjungan::where('status', 'menunggu')->count(),
            'unreadPengaduan' => Pengaduan::where('is_read', false)->count(),

        ], $data);
    }
}