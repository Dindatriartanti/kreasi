<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kontributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    protected string $title = 'Data User';

    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

            })
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', $this->pageData([
            'users' => $users,
            'search' => $search,
        ]));
    }

    public function create()
    {
        return view('admin.user.create', $this->pageData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|max:100',
            'username'  => 'required|max:50|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'no_hp'     => 'nullable|max:20',
            'password'  => 'required|min:6|confirmed',
            'role'      => 'required|in:admin,kontributor',
            'status'    => 'required|in:aktif,nonaktif',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        DB::transaction(function () use ($validated) {

            $user = User::create($validated);

            if ($user->role === 'kontributor') {

                Kontributor::create([
                    'id_user'           => $user->id,
                    'nama_kontributor'  => $user->name,
                    'deskripsi'         => null,
                    'alamat'            => null,
                    'no_hp'             => $user->no_hp,
                    'email'             => $user->email,
                    'instagram'         => null,
                    'facebook'          => null,
                    'youtube'           => null,
                    'website'           => null,
                    'foto_profil'       => null,
                    'foto_banner'       => null,
                    'status'            => $user->status,
                ]);

            }

        });

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', $this->pageData([
            'user' => $user,
        ]));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => 'required|max:100',
            'username'  => 'required|max:50|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'no_hp'     => 'nullable|max:20',
            'status'    => 'required|in:aktif,nonaktif',
        ]);

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:6|confirmed',
            ]);

            $validated['password'] = Hash::make($request->password);
        }

        DB::transaction(function () use ($validated, $user) {

            $user->update($validated);

            if ($user->role === 'kontributor' && $user->kontributor) {

                $user->kontributor->update([
                    'nama_kontributor' => $user->name,
                    'email'            => $user->email,
                    'no_hp'            => $user->no_hp,
                    'status'           => $user->status,
                ]);

            }

        });

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Data user berhasil dihapus.');
    }
}