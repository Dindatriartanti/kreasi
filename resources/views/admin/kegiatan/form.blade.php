<div class="row">

    {{-- =========================================================
         INFORMASI KEGIATAN
         ========================================================= --}}
    <div class="col-lg-8">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <strong>
                    Informasi Kegiatan
                </strong>

            </div>

            <div class="card-body">

                {{-- Kategori + Nama --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kategori
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="id_kategori"
                            class="form-select @error('id_kategori') is-invalid @enderror">

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($kategori as $item)

                                <option
                                    value="{{ $item->id_kategori }}"
                                    @selected(
                                        old(
                                            'id_kategori',
                                            $kegiatan->id_kategori ?? ''
                                        ) == $item->id_kategori
                                    )>

                                    {{ $item->nama_kategori }}

                                </option>

                            @endforeach

                        </select>

                        @error('id_kategori')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nama Kegiatan

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="nama_kegiatan"
                            class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan ?? '') }}"
                            placeholder="Masukkan nama kegiatan">

                        @error('nama_kegiatan')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- Lokasi --}}
                <div class="mb-3">

                    <label class="form-label">

                        Lokasi Kegiatan

                    </label>

                    <input
                        type="text"
                        name="lokasi_kegiatan"
                        class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                        value="{{ old('lokasi_kegiatan', $kegiatan->lokasi_kegiatan ?? '') }}"
                        placeholder="Masukkan lokasi kegiatan">

                    @error('lokasi_kegiatan')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Deskripsi --}}
                <div class="mb-3">

                    <label class="form-label">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi_kegiatan"
                        rows="6"
                        class="form-control @error('deskripsi_kegiatan') is-invalid @enderror"
                        placeholder="Masukkan deskripsi kegiatan">{{ old('deskripsi_kegiatan', $kegiatan->deskripsi_kegiatan ?? '') }}</textarea>

                    @error('deskripsi_kegiatan')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Tanggal --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Mulai

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_mulai"
                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                            value="{{ old(
                                'tanggal_mulai',
                                isset($kegiatan) && $kegiatan->tanggal_mulai
                                    ? $kegiatan->tanggal_mulai->format('Y-m-d\TH:i')
                                    : ''
                            ) }}">

                        @error('tanggal_mulai')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Selesai

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_selesai"
                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                            value="{{ old(
                                'tanggal_selesai',
                                isset($kegiatan) && $kegiatan->tanggal_selesai
                                    ? $kegiatan->tanggal_selesai->format('Y-m-d\TH:i')
                                    : ''
                            ) }}">

                        @error('tanggal_selesai')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PENGATURAN
         ========================================================= --}}
    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <strong>
                    Pengaturan
                </strong>

            </div>

            <div class="card-body">


                {{-- Poster --}}
                <div class="mb-3">

                    <label class="form-label">

                        Poster

                    </label>

                    <input
                        type="file"
                        id="poster"
                        name="poster"
                        class="form-control @error('poster') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp,image/*">

                    @error('poster')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                    <small class="text-muted">

                        JPG, JPEG, PNG atau WEBP. Maksimal 10 MB.

                    </small>

                </div>


                {{-- Preview --}}
                <div class="text-center mb-4">

                    <img
                        id="preview"
                        src="{{ isset($kegiatan) && $kegiatan->poster
                            ? asset('storage/' . $kegiatan->poster)
                            : asset('assets/images/no-image.png') }}"
                        class="img-fluid rounded border"
                        style="max-height:260px; object-fit:cover;">

                </div>


                {{-- Kuota --}}
                <div class="mb-3">

                    <label class="form-label">

                        Kuota Peserta

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="number"
                        min="1"
                        name="kuota"
                        class="form-control @error('kuota') is-invalid @enderror"
                        value="{{ old('kuota', $kegiatan->kuota ?? 10) }}"
                        placeholder="Contoh: 10">

                    @error('kuota')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Booking --}}
                <div class="mb-3">

                    <label class="form-label">

                        Booking

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="is_booking"
                        class="form-select @error('is_booking') is-invalid @enderror">

                        <option
                            value="ya"
                            @selected(
                                old(
                                    'is_booking',
                                    $kegiatan->is_booking ?? 'ya'
                                ) === 'ya'
                            )>

                            Ya

                        </option>

                        <option
                            value="tidak"
                            @selected(
                                old(
                                    'is_booking',
                                    $kegiatan->is_booking ?? 'ya'
                                ) === 'tidak'
                            )>

                            Tidak

                        </option>

                    </select>

                    @error('is_booking')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">

                        Status

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror">

                        <option
                            value="draft"
                            @selected(
                                old(
                                    'status',
                                    $kegiatan->status ?? 'draft'
                                ) === 'draft'
                            )>

                            Draft

                        </option>

                        <option
                            value="publish"
                            @selected(
                                old(
                                    'status',
                                    $kegiatan->status ?? 'draft'
                                ) === 'publish'
                            )>

                            Publish

                        </option>

                        <option
                            value="selesai"
                            @selected(
                                old(
                                    'status',
                                    $kegiatan->status ?? 'draft'
                                ) === 'selesai'
                            )>

                            Selesai

                        </option>

                    </select>

                    @error('status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     BUTTON
     ========================================================= --}}

<div class="d-flex justify-content-end mt-3">

    <a
        href="{{ route('admin.kegiatan.index') }}"
        class="btn btn-secondary me-2">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</div>


{{-- =========================================================
     PREVIEW POSTER
     ========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const poster = document.getElementById('poster');
    const preview = document.getElementById('preview');

    if (poster && preview) {

        poster.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                preview.src = e.target.result;

            };

            reader.readAsDataURL(file);

        });

    }

});

</script>

@endpush