<div class="row">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <strong>Informasi Koleksi</strong>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <select name="id_kategori"
                            class="form-select @error('id_kategori') is-invalid @enderror">

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($kategori as $item)

                            <option value="{{ $item->id_kategori }}"
                                {{ old('id_kategori', $koleksi->id_kategori ?? '') == $item->id_kategori ? 'selected' : '' }}>

                                {{ $item->nama_kategori }}

                            </option>

                        @endforeach

                    </select>

                    @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Nama Koleksi

                    </label>

                    <input type="text"
                           name="nama_koleksi"
                           class="form-control @error('nama_koleksi') is-invalid @enderror"
                           value="{{ old('nama_koleksi', $koleksi->nama_koleksi ?? '') }}"
                           placeholder="Masukkan nama koleksi">

                    @error('nama_koleksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Lokasi Penyimpanan

                    </label>

                    <input type="text"
                           name="lokasi"
                           class="form-control"
                           value="{{ old('lokasi', $koleksi->lokasi ?? '') }}"
                           placeholder="Contoh : Gedung A, Rak 3">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi"
                        rows="6"
                        class="form-control">{{ old('deskripsi', $koleksi->deskripsi ?? '') }}</textarea>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">

                <strong>Pengaturan</strong>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Gambar Koleksi

                    </label>

                    <input type="file"
                           name="gambar"
                           id="gambar"
                           class="form-control"
                           accept="image/*">

                </div>

                <div class="text-center mb-3">

                    <img
                        id="preview"
                        src="{{ isset($koleksi) && $koleksi->gambar ? asset('storage/'.$koleksi->gambar) : asset('assets/images/no-image.png') }}"
                        class="img-fluid rounded border"
                        style="max-height:250px">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="dipamerkan"
                            {{ old('status', $koleksi->status ?? '') == 'dipamerkan' ? 'selected' : '' }}>

                            Dipamerkan

                        </option>

                        <option value="disimpan"
                            {{ old('status', $koleksi->status ?? '') == 'disimpan' ? 'selected' : '' }}>

                            Disimpan

                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="d-flex justify-content-end mt-4">

    <a href="{{ route('admin.koleksi.index') }}"
       class="btn btn-secondary me-2">

        Kembali

    </a>

    <button class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</div>

<script>

document.getElementById('gambar').addEventListener('change',function(e){

    const reader = new FileReader();

    reader.onload=function(){

        document.getElementById('preview').src=reader.result;

    }

    reader.readAsDataURL(e.target.files[0]);

});

</script>