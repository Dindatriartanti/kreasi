<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Login',
            'showRegisterLink' => true,
        ]);
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Login
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {

            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.'
                ])
                ->onlyInput('username');
        }

        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Cek Status Akun
        |--------------------------------------------------------------------------
        */

        if ($user->status !== 'aktif') {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return back()
                ->withErrors([
                    'username' => 'Akun Anda belum aktif. Silakan menunggu aktivasi dari admin.'
                ])
                ->onlyInput('username');
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Selamat datang, ' . $user->name . '!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | KONTRIBUTOR
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'kontributor') {

            return redirect()
                ->route('kontributor.dashboard')
                ->with(
                    'success',
                    'Selamat datang, ' . $user->name . '!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Role Tidak Dikenal
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'error',
                'Role pengguna tidak dikenali.'
            );
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        /*
        |--------------------------------------------------------------------------
        | Hancurkan Session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        /*
        |--------------------------------------------------------------------------
        | Buat CSRF Token Baru
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | Kembali ke Login
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}