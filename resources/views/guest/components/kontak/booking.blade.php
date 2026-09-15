<div class="service-header">

    <h3>Pendaftaran Kunjungan</h3>

    <p>

        Isi formulir berikut untuk melakukan booking
        kunjungan ke Ruang Kreasi.

    </p>

</div>


<form
    action="{{ route('guest.booking.store') }}"
    method="POST">

    @csrf


    {{-- ============================= --}}
    {{-- Nama Pemesan --}}
    {{-- ============================= --}}

    <div class="mb-3">

        <label class="form-label">

            Nama Pemesan

        </label>

        <input
            type="text"
            name="nama_pemesan"
            class="form-control @error('nama_pemesan') is-invalid @enderror"
            value="{{ old('nama_pemesan') }}"
            placeholder="Masukkan nama lengkap"
            required>

        @error('nama_pemesan')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Nomor HP --}}
    {{-- ============================= --}}

    <div class="mb-3">

        <label class="form-label">

            Nomor HP

        </label>

        <input
            type="text"
            name="no_hp"
            class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp') }}"
            placeholder="08xxxxxxxxxx"
            required>

        @error('no_hp')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Email --}}
    {{-- ============================= --}}

    <div class="mb-3">

        <label class="form-label">

            Email

        </label>

        <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}"
            placeholder="nama@email.com"
            required>

        @error('email')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Instansi --}}
    {{-- ============================= --}}

    <div class="mb-3">

        <label class="form-label">

            Instansi

        </label>

        <input
            type="text"
            name="instansi"
            class="form-control @error('instansi') is-invalid @enderror"
            value="{{ old('instansi') }}"
            placeholder="Nama instansi/sekolah/perusahaan"
            required>

        @error('instansi')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Tujuan --}}
    {{-- ============================= --}}

    <div class="mb-3">

        <label class="form-label">

            Tujuan

        </label>

        <select
            name="tujuan"
            class="form-select @error('tujuan') is-invalid @enderror"
            required>

            <option value="">

                Pilih Tujuan

            </option>

            <option
                value="Kunjungan"
                {{ old('tujuan') == 'Kunjungan' ? 'selected' : '' }}>

                Kunjungan

            </option>

            <option
                value="Magang"
                {{ old('tujuan') == 'Magang' ? 'selected' : '' }}>

                Magang

            </option>

            <option
                value="Penelitian"
                {{ old('tujuan') == 'Penelitian' ? 'selected' : '' }}>

                Penelitian

            </option>

        </select>

        @error('tujuan')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Jumlah Pengunjung --}}
    {{-- ============================= --}}

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">

                Dewasa

            </label>

            <input
                type="number"
                name="dewasa"
                class="form-control @error('dewasa') is-invalid @enderror"
                value="{{ old('dewasa', 0) }}"
                min="0"
                required>

            @error('dewasa')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <div class="col-md-6 mb-3">

            <label class="form-label">

                Anak

            </label>

            <input
                type="number"
                name="anak"
                class="form-control @error('anak') is-invalid @enderror"
                value="{{ old('anak', 0) }}"
                min="0"
                required>

            @error('anak')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </div>


    {{-- ============================= --}}
    {{-- Tanggal --}}
    {{-- ============================= --}}

    <div class="mb-4">

        <label class="form-label">

            Tanggal Kunjungan

        </label>

        <input
            type="date"
            name="tanggal"
            class="form-control @error('tanggal') is-invalid @enderror"
            value="{{ old('tanggal') }}"
            required>

        @error('tanggal')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>


    {{-- ============================= --}}
    {{-- Button --}}
    {{-- ============================= --}}

    <button
        type="submit"
        class="btn btn-primary rounded-pill px-4">

        <i class="bi bi-calendar-check me-1"></i>

        Booking Sekarang

    </button>
</br>
</br>
</br>
    <p>
        <b>Isi formulir berikut dengan benar, tunggu 1x24 Jam maka akan dikirim email konfirmasi beserta tiket booking oleh admin.</b>

    </p>
</form>