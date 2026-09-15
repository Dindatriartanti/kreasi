<?php

namespace App\Http\Controllers\Kontributor;

use App\Http\Controllers\Controller;
use App\Models\Kontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function show()
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        return view('kontributor.profil.show', [

            'title' => 'Profil Saya',

            'kontributor' => $kontributor,

        ]);
    }

    public function edit()
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        return view('kontributor.profil.edit', [

            'title' => 'Edit Profil',

            'kontributor' => $kontributor,

        ]);
    }

    public function update(Request $request)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        $validated = $request->validate([

            'nama_kontributor' => 'required|max:150',

            'deskripsi' => 'nullable',

            'alamat' => 'nullable',

            'instagram' => 'nullable|max:100',

            'facebook' => 'nullable|max:100',

            'youtube' => 'nullable|max:100',

            'website' => 'nullable|max:255',

            'foto_profil' => 'nullable|image|max:2048',

            'foto_banner' => 'nullable|image|max:4096',

            'bukti_karya' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',

        ]);

        $validated['slug'] = Str::slug(
            $validated['nama_kontributor']
        );

        if ($request->hasFile('foto_profil')) {

            if (
                $kontributor->foto_profil &&
                Storage::disk('public')->exists($kontributor->foto_profil)
            ) {

                Storage::disk('public')
                    ->delete($kontributor->foto_profil);

            }

            $validated['foto_profil'] = $request
                ->file('foto_profil')
                ->store('kontributor/profil', 'public');

        }

        if ($request->hasFile('foto_banner')) {

            if (
                $kontributor->foto_banner &&
                Storage::disk('public')->exists($kontributor->foto_banner)
            ) {

                Storage::disk('public')
                    ->delete($kontributor->foto_banner);

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
            ->route('kontributor.profil.show')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}