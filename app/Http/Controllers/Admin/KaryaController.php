<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Karya;
use App\Models\KategoriKontributor;
use App\Models\Kontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryaController extends AdminController
{
    protected string $title = 'Moderasi Karya';

    /**
     * Daftar karya
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $kontributor = $request->kontributor;
        $kategori = $request->kategori;
        $status = $request->status;

        $karya = Karya::with([
                'kontributor',
                'kategoriKontributor'
            ])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('judul_karya', 'like', "%{$search}%")
                      ->orWhere('deskripsi_karya', 'like', "%{$search}%");

                });

            })

            ->when($kontributor, function ($query) use ($kontributor) {

                $query->where('id_kontributor', $kontributor);

            })

            ->when($kategori, function ($query) use ($kategori) {

                $query->where('id_kategori_kontributor', $kategori);

            })

            ->when($status, function ($query) use ($status) {

                $query->where('status', $status);

            })

            ->latest('tanggal_upload')
            ->paginate(10)
            ->withQueryString();

        return view('admin.karya.index', $this->pageData([

            'karya' => $karya,

            'search' => $search,

            'kontributor' => $kontributor,

            'kategori' => $kategori,

            'status' => $status,

            'kontributors' => Kontributor::where('status', 'aktif')
                ->orderBy('nama_kontributor')
                ->get(),

            'kategoriKontributors' => KategoriKontributor::where('status', 'aktif')
                ->orderBy('nama_kategori')
                ->get(),

        ]));
    }

    /**
     * Detail karya
     */
    public function show(Karya $karya)
    {
        $karya->load([
            'kontributor',
            'kategoriKontributor'
        ]);

        return view('admin.karya.show', $this->pageData([

            'karya' => $karya,

        ]));
    }

    /**
     * Form moderasi
     */
    public function edit(Karya $karya)
    {
        $karya->load([
            'kontributor',
            'kategoriKontributor'
        ]);

        return view('admin.karya.edit', $this->pageData([

            'karya' => $karya,

            'kategoriKontributors' => KategoriKontributor::where('status', 'aktif')
                ->orderBy('nama_kategori')
                ->get(),

        ]));
    }

    /**
     * Simpan moderasi
     */
    public function update(Request $request, Karya $karya)
    {
        $validated = $request->validate([

            'id_kategori_kontributor' => [
                'required',
                'exists:kategori_kontributor,id_kategori_kontributor'
            ],

            'status' => [
                'required',
                'in:review,publish,ditolak'
            ],

        ]);

        $karya->update($validated);

        return redirect()
            ->route('admin.karya.index')
            ->with('success', 'Moderasi karya berhasil diperbarui.');
    }

    /**
     * Hapus karya
     */
    public function destroy(Karya $karya)
    {
        if (
            $karya->thumbnail &&
            Storage::disk('public')->exists($karya->thumbnail)
        ) {

            Storage::disk('public')->delete($karya->thumbnail);

        }

        if (
            $karya->file_karya &&
            Storage::disk('public')->exists($karya->file_karya)
        ) {

            Storage::disk('public')->delete($karya->file_karya);

        }

        $karya->delete();

        return redirect()
            ->route('admin.karya.index')
            ->with('success', 'Karya berhasil dihapus.');
    }
}