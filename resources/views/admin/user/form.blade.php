<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">Nama</label>

        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name ?? '') }}"
               placeholder="Masukkan nama">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Username</label>

        <input type="text"
               name="username"
               class="form-control @error('username') is-invalid @enderror"
               value="{{ old('username', $user->username ?? '') }}"
               placeholder="Masukkan username">

        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">Email</label>

        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email ?? '') }}"
               placeholder="Masukkan email">

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">No. HP</label>

        <input type="text"
               name="no_hp"
               class="form-control @error('no_hp') is-invalid @enderror"
               value="{{ old('no_hp', $user->no_hp ?? '') }}"
               placeholder="08xxxxxxxxxx">

        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">Role</label>

        <select name="role"
                class="form-select @error('role') is-invalid @enderror">

            <option value="">-- Pilih Role --</option>

            <option value="admin"
                {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                Admin
            </option>

            <option value="kontributor"
                {{ old('role', $user->role ?? '') == 'kontributor' ? 'selected' : '' }}>
                Kontributor
            </option>

        </select>

        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Status</label>

        <select name="status"
                class="form-select @error('status') is-invalid @enderror">

            <option value="">-- Pilih Status --</option>

            <option value="aktif"
                {{ old('status', $user->status ?? '') == 'aktif' ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="nonaktif"
                {{ old('status', $user->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Password
            @isset($user)
                <small class="text-muted">(Kosongkan jika tidak diubah)</small>
            @endisset
        </label>

        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror">

        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">Konfirmasi Password</label>

        <input type="password"
               name="password_confirmation"
               class="form-control">

    </div>

</div>

<div class="text-end">

    <a href="{{ route('admin.user.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

    <button type="submit"
            class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</div>