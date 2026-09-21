<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kontributor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    /**
     * Proses registrasi kontributor.
     */
    public function register(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'bukti_karya' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:5120',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Mulai Transaksi Database
        |--------------------------------------------------------------------------
        */

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Upload Bukti Karya
            |--------------------------------------------------------------------------
            */

            $buktiKarya = null;

            if ($request->hasFile('bukti_karya')) {

                $buktiKarya = $request
                    ->file('bukti_karya')
                    ->store(
                        'kontributor/bukti',
                        'public'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Buat User
            |--------------------------------------------------------------------------
            */

            $user = User::create([

                'name' => $validated['name'],

                'username' => $validated['username'],

                'email' => $validated['email'],

                'password' => Hash::make(
                    $validated['password']
                ),

                'role' => 'kontributor',

                'no_hp' => $validated['no_hp'] ?? null,

                'status' => 'nonaktif',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Buat Slug Kontributor
            |--------------------------------------------------------------------------
            */

            $slug = Str::slug(
                $validated['username']
            );

            /*
            |--------------------------------------------------------------------------
            | Pastikan Slug Unik
            |--------------------------------------------------------------------------
            */

            $originalSlug = $slug;

            $counter = 1;

            while (
                Kontributor::where(
                    'slug',
                    $slug
                )->exists()
            ) {

                $slug = $originalSlug . '-' . $counter;

                $counter++;
            }

            /*
            |--------------------------------------------------------------------------
            | Buat Data Kontributor
            |--------------------------------------------------------------------------
            */

            Kontributor::create([

                'id_user' => $user->id,

                'nama_kontributor' => $validated['name'],

                'slug' => $slug,

                'email' => $validated['email'],

                'no_hp' => $validated['no_hp'] ?? null,

                'bukti_karya' => $buktiKarya,

                'status' => 'nonaktif',

            ]);

            /*
            |--------------------------------------------------------------------------
            | Commit Transaksi
            |--------------------------------------------------------------------------
            */

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | Tidak Login Otomatis
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Registrasi berhasil. Akun Anda masih menunggu aktivasi admin. Silakan hubungi admin untuk mengaktifkan status akun Anda.'
                );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback Database
            |--------------------------------------------------------------------------
            */

            DB::rollBack();

            /*
            |--------------------------------------------------------------------------
            | Hapus File Jika Database Gagal
            |--------------------------------------------------------------------------
            */

            if (!empty($buktiKarya)) {

                Storage::disk('public')
                    ->delete($buktiKarya);
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Error ke Log
            |--------------------------------------------------------------------------
            */

            Log::error(
                'Registrasi kontributor gagal.',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Kembali ke Form Registrasi
            |--------------------------------------------------------------------------
            */

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Registrasi gagal: ' .
                    $e->getMessage()
                );
        }
    }
}