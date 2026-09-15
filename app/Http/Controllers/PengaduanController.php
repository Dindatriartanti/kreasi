<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | WEBSITE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('guest.kontak', [
            'title' => 'Kontak Kami'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['is_read'] = false;

        Pengaduan::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Pengaduan berhasil dikirim. Terima kasih atas masukan Anda.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $pengaduan = Pengaduan::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengaduan.index', [
            'title'      => 'Data Pengaduan',
            'pengaduan'  => $pengaduan,
            'search'     => $search,
        ]);
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', [
            'title'     => 'Detail Pengaduan',
            'pengaduan' => $pengaduan,
        ]);
    }

    public function edit(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.edit', [
            'title'     => 'Detail Pengaduan',
            'pengaduan' => $pengaduan,
        ]);
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'is_read' => 'required|boolean',
        ]);

        $pengaduan->update($validated);

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}