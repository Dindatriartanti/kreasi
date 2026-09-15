<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KoleksiController extends AdminController
{
    protected string $title = 'Data Koleksi';

    public function index(Request $request)
    {
        $search = $request->search;

        $koleksi = Koleksi::with('kategori')
            ->when($search, function ($query) use ($search) {

                $query->where('nama_koleksi', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%");

            })
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.koleksi.index', $this->pageData([
            'koleksi' => $koleksi,
            'search' => $search,
        ]));
    }

    public function create()
    {
        $kategori = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.koleksi.create', $this->pageData([
            'kategori' => $kategori,
        ]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'   => 'required|exists:kategori,id_kategori',
            'nama_koleksi'  => 'required|max:255',
            'deskripsi'     => 'nullable',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lokasi'        => 'nullable|max:255',
            'status'        => 'required|in:dipamerkan,disimpan',
        ]);

        $validated['slug'] = Str::slug($validated['nama_koleksi']);

        if ($request->hasFile('gambar')) {

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('koleksi', 'public');

        }

        Koleksi::create($validated);

        return redirect()
            ->route('admin.koleksi.index')
            ->with('success', 'Data koleksi berhasil ditambahkan.');
    }

    public function edit(Koleksi $koleksi)
    {
        $kategori = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.koleksi.edit', $this->pageData([
            'koleksi' => $koleksi,
            'kategori' => $kategori,
        ]));
    }

    public function update(Request $request, Koleksi $koleksi)
    {
        $validated = $request->validate([
            'id_kategori'   => 'required|exists:kategori,id_kategori',
            'nama_koleksi'  => 'required|max:255',
            'deskripsi'     => 'nullable',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lokasi'        => 'nullable|max:255',
            'status'        => 'required|in:dipamerkan,disimpan',
        ]);

        $validated['slug'] = Str::slug($validated['nama_koleksi']);

        if ($request->hasFile('gambar')) {

            if ($koleksi->gambar && Storage::disk('public')->exists($koleksi->gambar)) {

                Storage::disk('public')->delete($koleksi->gambar);

            }

            $validated['gambar'] = $request
                ->file('gambar')
                ->store('koleksi', 'public');

        }

        $koleksi->update($validated);

        return redirect()
            ->route('admin.koleksi.index')
            ->with('success', 'Data koleksi berhasil diperbarui.');
    }

    public function destroy(Koleksi $koleksi)
    {
        if ($koleksi->gambar && Storage::disk('public')->exists($koleksi->gambar)) {

            Storage::disk('public')->delete($koleksi->gambar);

        }

        $koleksi->delete();

        return redirect()
            ->route('admin.koleksi.index')
            ->with('success', 'Data koleksi berhasil dihapus.');
    }
}