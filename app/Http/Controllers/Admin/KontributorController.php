<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KontributorController extends AdminController
{
    protected string $title = 'Data Kontributor';

    public function index(Request $request)
    {
        $search = $request->search;

        $kontributors = Kontributor::with('user')
            ->withCount('karya')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kontributor', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.kontributor.index', $this->pageData([
            'kontributors' => $kontributors,
            'search'       => $search,
        ]));
    }

    public function show(Kontributor $kontributor)
    {
        $kontributor->load([
            'user',
            'karya.kategoriKontributor',
        ]);

        return view('admin.kontributor.show', $this->pageData([
            'kontributor' => $kontributor,
        ]));
    }

    public function edit(Kontributor $kontributor)
    {
        return view('admin.kontributor.edit', $this->pageData([
            'kontributor' => $kontributor,
        ]));
    }

    public function update(Request $request, Kontributor $kontributor)
    {
        $validated = $request->validate([
            'nama_kontributor' => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'alamat'           => 'nullable|string|max:255',
            'instagram'        => 'nullable|max:255',
            'facebook'         => 'nullable|max:255',
            'youtube'          => 'nullable|max:255',
            'website'          => 'nullable|max:255',
            'foto_profil'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_banner'      => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'bukti_karya'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'status'           => 'required|in:aktif,nonaktif',
        ]);

        // Generate slug
        $validated['slug'] = $this->generateSlug(
            $validated['nama_kontributor'],
            $kontributor->id_kontributor
        );

        // Upload Foto Profil
        if ($request->hasFile('foto_profil')) {

            if (
                $kontributor->foto_profil &&
                Storage::disk('public')->exists($kontributor->foto_profil)
            ) {
                Storage::disk('public')->delete($kontributor->foto_profil);
            }

            $validated['foto_profil'] = $request
                ->file('foto_profil')
                ->store('kontributor/profil', 'public');
        }

        // Upload Banner
        if ($request->hasFile('foto_banner')) {

            if (
                $kontributor->foto_banner &&
                Storage::disk('public')->exists($kontributor->foto_banner)
            ) {
                Storage::disk('public')->delete($kontributor->foto_banner);
            }

            $validated['foto_banner'] = $request
                ->file('foto_banner')
                ->store('kontributor/banner', 'public');
        }

        if ($request->hasFile('bukti_karya')) {

            if (
                $kontributor->bukti_karya &&
                Storage::disk('public')->exists($kontributor->bukti_karya)
            ) {
                Storage::disk('public')->delete($kontributor->bukti_karya);
            }

            $validated['bukti_karya'] = $request
                ->file('bukti_karya')
                ->store('kontributor/bukti', 'public');
        }

        $kontributor->update($validated);

        return redirect()
            ->route('admin.kontributor.index')
            ->with('success', 'Profil kontributor berhasil diperbarui.');
    }

    /**
     * Generate slug unik.
     */
    private function generateSlug(string $nama, ?int $ignoreId = null): string
    {
        $slug = Str::slug($nama);

        $query = Kontributor::where('slug', 'LIKE', "{$slug}%");

        if ($ignoreId) {
            $query->where('id_kontributor', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}