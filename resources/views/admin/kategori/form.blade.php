<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Nama Kategori
            <span class="text-danger">*</span>
        </label>

        <input type="text"
               name="nama_kategori"
               class="form-control @error('nama_kategori') is-invalid @enderror"
               value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
               placeholder="Masukkan nama kategori">

        @error('nama_kategori')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Status
            <span class="text-danger">*</span>
        </label>

        <select name="status"
                class="form-select @error('status') is-invalid @enderror">

            <option value="">-- Pilih Status --</option>

            <option value="aktif"
                {{ old('status', $kategori->status ?? '') == 'aktif' ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="nonaktif"
                {{ old('status', $kategori->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

<div class="mb-3">

    <label class="form-label">
        Icon
    </label>

    <input type="text"
           name="icon"
           class="form-control @error('icon') is-invalid @enderror"
           value="{{ old('icon', $kategori->icon ?? '') }}"
           placeholder="Contoh: bi bi-palette">

    <small class="text-muted">

        Gunakan class Bootstrap Icons.
        Contoh:
        <code>bi bi-palette</code>,
        <code>bi bi-camera</code>,
        <code>bi bi-image</code>,
        <code>bi bi-film</code>,
        <code>bi bi-book</code>

    </small>

    @error('icon')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">

        Deskripsi

    </label>

    <textarea
        name="deskripsi"
        rows="5"
        class="form-control @error('deskripsi') is-invalid @enderror"
        placeholder="Masukkan deskripsi kategori...">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>

    @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>

<div class="d-flex justify-content-end">

    <a href="{{ route('admin.kategori.index') }}"
       class="btn btn-secondary me-2">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

    <button type="submit"
            class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</div>