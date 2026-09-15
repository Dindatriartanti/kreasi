<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends AdminController
{
    protected string $title = 'Data Kegiatan';

    public function index(Request $request)
    {
        $search = $request->search;

        $kegiatan = Kegiatan::with('kategori')
            ->when($search, function ($query) use ($search) {

                $query->where('nama_kegiatan', 'like', "%{$search}%")
                      ->orWhere('lokasi_kegiatan', 'like', "%{$search}%");

            })
            ->latest('tanggal_mulai')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kegiatan.index', $this->pageData([
            'kegiatan' => $kegiatan,
            'search' => $search,
        ]));
    }

    public function create()
    {
        $kategori = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.kegiatan.create', $this->pageData([
            'kategori' => $kategori,
        ]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori'      => 'required|exists:kategori,id_kategori',
            'nama_kegiatan'    => 'required|max:255',
            'deskripsi_kegiatan' => 'nullable',
            'poster'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'lokasi_kegiatan'  => 'nullable|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'kuota'            => 'required|integer|min:1',
            'is_booking'       => 'required|in:ya,tidak',
            'status'           => 'required|in:draft,publish,selesai',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kegiatan']);

        if ($request->hasFile('poster')) {

            $validated['poster'] = $request
                ->file('poster')
                ->store('kegiatan', 'public');

        }

        Kegiatan::create($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kategori = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.kegiatan.edit', $this->pageData([
            'kegiatan' => $kegiatan,
            'kategori' => $kategori,
        ]));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'id_kategori'      => 'required|exists:kategori,id_kategori',
            'nama_kegiatan'    => 'required|max:255',
            'deskripsi_kegiatan' => 'nullable',
            'poster'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lokasi_kegiatan'  => 'nullable|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'kuota'            => 'required|integer|min:1',
            'is_booking'       => 'required|in:ya,tidak',
            'status'           => 'required|in:draft,publish,selesai',
        ]);

        $validated['slug'] = Str::slug($validated['nama_kegiatan']);

        if ($request->hasFile('poster')) {

            if ($kegiatan->poster && Storage::disk('public')->exists($kegiatan->poster)) {

                Storage::disk('public')->delete($kegiatan->poster);

            }

            $validated['poster'] = $request
                ->file('poster')
                ->store('kegiatan', 'public');

        }

        $kegiatan->update($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->poster && Storage::disk('public')->exists($kegiatan->poster)) {

            Storage::disk('public')->delete($kegiatan->poster);

        }

        $kegiatan->delete();

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}