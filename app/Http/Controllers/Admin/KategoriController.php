<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends AdminController
{
    protected string $title = 'Data Kategori';

    public function index(Request $request)
    {
        $search = $request->search;

        $kategori = Kategori::when($search, function ($query) use ($search) {

                $query->where('nama_kategori', 'like', "%{$search}%")
                      ->orWhere('slug', 'like', "%{$search}%");

            })
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kategori.index', $this->pageData([
            'kategori' => $kategori,
            'search' => $search,
        ]));
    }

    public function create()
    {
        return view('admin.kategori.create', $this->pageData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|max:100|unique:kategori,nama_kategori',
            'deskripsi'     => 'nullable',
            'icon'          => 'nullable|max:255',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kategori']);

        Kategori::create($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', $this->pageData([
            'kategori' => $kategori,
        ]));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|max:100|unique:kategori,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            'deskripsi'     => 'nullable',
            'icon'          => 'nullable|max:255',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kategori']);

        $kategori->update($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}