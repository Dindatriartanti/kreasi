<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $kategori = $request->kategori;

        $koleksi = Koleksi::with('kategori')
            ->where('status', 'dipamerkan')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_koleksi', 'like', "%{$search}%");
            })
            ->when($kategori, function ($query) use ($kategori) {
                $query->where('id_kategori', $kategori);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('guest.koleksi.index', [
            'title' => 'Koleksi Museum',
            'koleksi' => $koleksi,
            'kategori' => Kategori::orderBy('nama_kategori')->get(),
            'search' => $search,
            'kategoriAktif' => $kategori,
        ]);
    }

    public function show($slug)
    {
        $koleksi = Koleksi::with('kategori')
            ->where('slug', $slug)
            ->where('status', 'dipamerkan')
            ->firstOrFail();

        $related = Koleksi::with('kategori')
            ->where('status', 'dipamerkan')
            ->where('id_kategori', $koleksi->id_kategori)
            ->where('id_koleksi', '!=', $koleksi->id_koleksi)
            ->latest()
            ->take(4)
            ->get();

        return view('guest.koleksi.show', [
            'title' => $koleksi->nama_koleksi,
            'koleksi' => $koleksi,
            'related' => $related,
        ]);
    }
}