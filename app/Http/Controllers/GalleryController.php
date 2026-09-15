<?php

namespace App\Http\Controllers;

class GalleryController extends Controller
{
    public function index()
    {
        return view('guest.gallery.index', [
            'title' => 'Galeri Karya',
        ]);
    }
}