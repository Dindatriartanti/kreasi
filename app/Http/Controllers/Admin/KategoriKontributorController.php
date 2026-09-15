<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Models\KategoriKontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriKontributorController extends AdminController
{
    protected string $title = 'Kategori Kontributor';

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->search;

        $kategoriKontributors = KategoriKontributor::with([
                'kategori'
            ])
            ->withCount('karya')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'nama_kategori',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'deskripsi',
                        'like',
                        "%{$search}%"
                    );

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.kategori-kontributor.index',
            $this->pageData([

                'kategoriKontributors' => $kategoriKontributors,

                'search' => $search,

            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.kategori-kontributor.create',
            $this->pageData([

                'kategori' => Kategori::where(
                        'status',
                        'aktif'
                    )
                    ->orderBy('nama_kategori')
                    ->get(),

            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'id_kategori' => [
                'required',
                'exists:kategori,id_kategori',
            ],

            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategori_kontributor,nama_kategori',
            ],

            'deskripsi' => 'nullable|string',

            'status' => 'required|in:aktif,nonaktif',

        ]);

        $validated['slug'] = $this->generateSlug(
            $validated['nama_kategori']
        );

        KategoriKontributor::create($validated);

        return redirect()
            ->route('admin.kategori-kontributor.index')
            ->with(
                'success',
                'Kategori Kontributor berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        KategoriKontributor $kategoriKontributor
    ) {

        return view(
            'admin.kategori-kontributor.edit',
            $this->pageData([

                'kategoriKontributor' => $kategoriKontributor,

                'kategori' => Kategori::where(
                        'status',
                        'aktif'
                    )
                    ->orderBy('nama_kategori')
                    ->get(),

            ])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        KategoriKontributor $kategoriKontributor
    ) {

        $validated = $request->validate([

            'id_kategori' => [
                'required',
                'exists:kategori,id_kategori',
            ],

            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategori_kontributor,nama_kategori,' .
                $kategoriKontributor->id_kategori_kontributor .
                ',id_kategori_kontributor',
            ],

            'deskripsi' => 'nullable|string',

            'status' => 'required|in:aktif,nonaktif',

        ]);

        $validated['slug'] = $this->generateSlug(

            $validated['nama_kategori'],

            $kategoriKontributor->id_kategori_kontributor

        );

        $kategoriKontributor->update($validated);

        return redirect()
            ->route('admin.kategori-kontributor.index')
            ->with(
                'success',
                'Kategori Kontributor berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(
        KategoriKontributor $kategoriKontributor
    ) {

        if ($kategoriKontributor->karya()->exists()) {

            return redirect()
                ->route('admin.kategori-kontributor.index')
                ->with(
                    'error',
                    'Kategori masih digunakan oleh karya.'
                );

        }

        $kategoriKontributor->delete();

        return redirect()
            ->route('admin.kategori-kontributor.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Slug
    |--------------------------------------------------------------------------
    */

    private function generateSlug(
        string $nama,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($nama);

        $query = KategoriKontributor::where(
            'slug',
            'LIKE',
            "{$slug}%"
        );

        if ($ignoreId) {

            $query->where(
                'id_kategori_kontributor',
                '!=',
                $ignoreId
            );

        }

        $count = $query->count();

        return $count
            ? "{$slug}-" . ($count + 1)
            : $slug;
    }
}