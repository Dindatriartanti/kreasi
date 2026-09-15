<?php

namespace App\Http\Controllers\Kontributor;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\KategoriKontributor;
use App\Models\Kontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KaryaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        $search = $request->search;
        $status = $request->status;

        $karya = Karya::with([
                'kategoriKontributor'
            ])
            ->where(
                'id_kontributor',
                $kontributor->id_kontributor
            )
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'judul_karya',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'deskripsi_karya',
                        'like',
                        "%{$search}%"
                    );

                });

            })

            ->when($status, function ($query) use ($status) {

                $query->where(
                    'status',
                    $status
                );

            })

            ->latest('tanggal_upload')

            ->paginate(10)

            ->withQueryString();

        return view(
            'kontributor.karya.index',
            [

                'title' => 'Karya Saya',

                'karya' => $karya,

                'search' => $search,

                'status' => $status,

            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $kategori = KategoriKontributor::with('kategori')

            ->where(
                'status',
                'aktif'
            )

            ->orderBy('nama_kategori')

            ->get();

        return view(
            'kontributor.karya.create',
            [

                'title' => 'Upload Karya',

                'kategori' => $kategori,

            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'id_kategori_kontributor' =>
                'required|exists:kategori_kontributor,id_kategori_kontributor',

            'judul_karya' =>
                'required|string|max:255',

            'deskripsi_karya' =>
                'nullable|string',

            'thumbnail' =>
                'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'file_karya' =>
                'required|max:51200',

        ]);

        try {

            $kontributor = Kontributor::where(
                'id_user',
                Auth::id()
            )->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Upload Thumbnail
            |--------------------------------------------------------------------------
            */

            $thumbnail = $request
                ->file('thumbnail')
                ->store(
                    'karya/thumbnail',
                    'public'
                );

            /*
            |--------------------------------------------------------------------------
            | Folder Otomatis
            |--------------------------------------------------------------------------
            */

            $extension = strtolower(

                $request
                    ->file('file_karya')
                    ->getClientOriginalExtension()

            );

            $folder = $this->getUploadFolder(
                $extension
            );

            /*
            |--------------------------------------------------------------------------
            | Upload File
            |--------------------------------------------------------------------------
            */

            $file = $request
                ->file('file_karya')
                ->store(
                    $folder,
                    'public'
                );

            /*
            |--------------------------------------------------------------------------
            | Simpan Database
            |--------------------------------------------------------------------------
            */

            $karya = new Karya();

            $karya->id_kontributor =

                $kontributor->id_kontributor;

            $karya->id_kategori_kontributor =

                $request->id_kategori_kontributor;

            $karya->judul_karya =

                $request->judul_karya;

            $karya->slug =

                $this->generateSlug(
                    $request->judul_karya
                );

            $karya->deskripsi_karya =

                $request->deskripsi_karya;

            $karya->thumbnail =

                $thumbnail;

            $karya->file_karya =

                $file;

            $karya->tanggal_upload =

                now();

            $karya->status =

                'review';

            $karya->save();

            return redirect()

                ->route('kontributor.karya.index')

                ->with(

                    'success',

                    'Karya berhasil diupload dan menunggu proses review.'

                );

        } catch (\Throwable $e) {

            return back()

                ->withInput()

                ->with(

                    'error',

                    $e->getMessage()

                );

        }
    }

        /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Karya $karya)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        abort_if(
            $karya->id_kontributor != $kontributor->id_kontributor,
            403
        );

        $karya->load([
            'kategoriKontributor',
            'kontributor',
        ]);

        return view(
            'kontributor.karya.show',
            [
                'title' => 'Detail Karya',
                'karya' => $karya,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Karya $karya)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        abort_if(
            $karya->id_kontributor != $kontributor->id_kontributor,
            403
        );

        $kategori = KategoriKontributor::with('kategori')
            ->where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view(
            'kontributor.karya.edit',
            [
                'title' => 'Edit Karya',
                'karya' => $karya,
                'kategori' => $kategori,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Karya $karya)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        abort_if(
            $karya->id_kontributor != $kontributor->id_kontributor,
            403
        );

        $request->validate([

            'id_kategori_kontributor' =>
                'required|exists:kategori_kontributor,id_kategori_kontributor',

            'judul_karya' =>
                'required|string|max:255',

            'deskripsi_karya' =>
                'nullable|string',

            'thumbnail' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'file_karya' =>
                'nullable|max:51200',

        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | Update Thumbnail
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('thumbnail')) {

                if (
                    $karya->thumbnail &&
                    Storage::disk('public')->exists($karya->thumbnail)
                ) {

                    Storage::disk('public')->delete(
                        $karya->thumbnail
                    );

                }

                $karya->thumbnail = $request
                    ->file('thumbnail')
                    ->store(
                        'karya/thumbnail',
                        'public'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Update File Karya
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('file_karya')) {

                if (
                    $karya->file_karya &&
                    Storage::disk('public')->exists($karya->file_karya)
                ) {

                    Storage::disk('public')->delete(
                        $karya->file_karya
                    );

                }

                $extension = strtolower(
                    $request
                        ->file('file_karya')
                        ->getClientOriginalExtension()
                );

                $folder = $this->getUploadFolder(
                    $extension
                );

                $karya->file_karya = $request
                    ->file('file_karya')
                    ->store(
                        $folder,
                        'public'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Update Data
            |--------------------------------------------------------------------------
            */

            $karya->id_kategori_kontributor =
                $request->id_kategori_kontributor;

            $karya->judul_karya =
                $request->judul_karya;

            $karya->slug =
                $this->generateSlug(
                    $request->judul_karya,
                    $karya->id_karya
                );

            $karya->deskripsi_karya =
                $request->deskripsi_karya;

            /*
            |--------------------------------------------------------------------------
            | Jika diedit kembali ke review
            |--------------------------------------------------------------------------
            */

            $karya->status = 'review';

            $karya->save();

            return redirect()
                ->route('kontributor.karya.index')
                ->with(
                    'success',
                    'Karya berhasil diperbarui.'
                );

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }
    }
        /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Karya $karya)
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        abort_if(
            $karya->id_kontributor != $kontributor->id_kontributor,
            403
        );

        try {

            /*
            |--------------------------------------------------------------------------
            | Hapus Thumbnail
            |--------------------------------------------------------------------------
            */

            if (
                $karya->thumbnail &&
                Storage::disk('public')->exists($karya->thumbnail)
            ) {

                Storage::disk('public')->delete(
                    $karya->thumbnail
                );

            }

            /*
            |--------------------------------------------------------------------------
            | Hapus File
            |--------------------------------------------------------------------------
            */

            if (
                $karya->file_karya &&
                Storage::disk('public')->exists($karya->file_karya)
            ) {

                Storage::disk('public')->delete(
                    $karya->file_karya
                );

            }

            $karya->delete();

            return redirect()
                ->route('kontributor.karya.index')
                ->with(
                    'success',
                    'Karya berhasil dihapus.'
                );

        } catch (\Throwable $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /*
    |--------------------------------------------------------------------------
    | REVIEW
    |--------------------------------------------------------------------------
    */

    public function review()
    {
        $kontributor = Kontributor::where(
            'id_user',
            Auth::id()
        )->firstOrFail();

        $karya = Karya::with([
                'kategoriKontributor'
            ])
            ->where(
                'id_kontributor',
                $kontributor->id_kontributor
            )
            ->where(
                'status',
                'review'
            )
            ->latest('tanggal_upload')
            ->paginate(10);

        return view(
            'kontributor.karya.review',
            [

                'title' => 'Karya Menunggu Review',

                'karya' => $karya,

            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE SLUG
    |--------------------------------------------------------------------------
    */

    private function generateSlug(
        string $judul,
        ?int $ignore = null
    ): string
    {
        $slug = Str::slug($judul);

        $originalSlug = $slug;

        $i = 1;

        while (

            Karya::where(
                'slug',
                $slug
            )

            ->when($ignore, function ($query) use ($ignore) {

                $query->where(
                    'id_karya',
                    '!=',
                    $ignore
                );

            })

            ->exists()

        ) {

            $slug = $originalSlug . '-' . $i;

            $i++;

        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | FOLDER UPLOAD
    |--------------------------------------------------------------------------
    */

    private function getUploadFolder(
        string $extension
    ): string
    {
        $extension = strtolower($extension);

        /*
        |--------------------------------------------------------------------------
        | Gambar
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [

            'jpg',

            'jpeg',

            'png',

            'webp',

        ])) {

            return 'karya/gambar';

        }

        /*
        |--------------------------------------------------------------------------
        | Video
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [

            'mp4',

            'mov',

            'avi',

            'mkv',

        ])) {

            return 'karya/video';

        }

        /*
        |--------------------------------------------------------------------------
        | Audio
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [

            'mp3',

            'wav',

            'aac',

            'ogg',

        ])) {

            return 'karya/audio';

        }

        /*
        |--------------------------------------------------------------------------
        | Dokumen
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [

            'pdf',

            'doc',

            'docx',

            'xls',

            'xlsx',

            'ppt',

            'pptx',

        ])) {

            return 'karya/dokumen';

        }

        /*
        |--------------------------------------------------------------------------
        | Arsip
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [

            'zip',

            'rar',

            '7z',

        ])) {

            return 'karya/arsip';

        }

        /*
        |--------------------------------------------------------------------------
        | Lainnya
        |--------------------------------------------------------------------------
        */

        return 'karya/lainnya';
    }
}