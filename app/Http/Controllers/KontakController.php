<?php

namespace App\Http\Controllers;

class KontakController extends Controller
{
    public function index()
    {
        return view('guest.kontak', [
            'title' => 'Kontak & Layanan'
        ]);
    }
}