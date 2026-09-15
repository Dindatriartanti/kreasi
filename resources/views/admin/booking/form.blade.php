<div class="row">

    {{-- ============================= --}}
    {{-- DATA PEMESAN --}}
    {{-- ============================= --}}

    <div class="col-lg-8">

        <div class="mb-3">

            <label class="form-label">
                Nama Pemesan
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $booking->nama_pemesan }}"
                readonly>

        </div>


        {{-- No HP --}}
        <div class="mb-3">

            <label class="form-label">
                Nomor HP
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $booking->no_hp ?? '-' }}"
                readonly>

        </div>


        {{-- Email --}}
        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                class="form-control"
                value="{{ $booking->email ?? '-' }}"
                readonly>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Instansi
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $booking->instansi }}"
                readonly>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Tujuan
            </label>

            <textarea
                class="form-control"
                rows="4"
                readonly>{{ $booking->tujuan }}</textarea>

        </div>

    </div>


    {{-- ============================= --}}
    {{-- DETAIL KUNJUNGAN --}}
    {{-- ============================= --}}

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body">

                {{-- Dewasa --}}
                <div class="mb-3">

                    <label class="form-label">
                        Dewasa
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $booking->dewasa }}"
                        readonly>

                </div>


                {{-- Anak --}}
                <div class="mb-3">

                    <label class="form-label">
                        Anak
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $booking->anak }}"
                        readonly>

                </div>


                {{-- Tanggal --}}
                <div class="mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}"
                        readonly>

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="menunggu"
                            @selected($booking->status == 'menunggu')>

                            Menunggu

                        </option>

                        <option
                            value="disetujui"
                            @selected($booking->status == 'disetujui')>

                            Disetujui

                        </option>

                        <option
                            value="ditolak"
                            @selected($booking->status == 'ditolak')>

                            Ditolak

                        </option>

                        <option
                            value="selesai"
                            @selected($booking->status == 'selesai')>

                            Selesai

                        </option>

                    </select>

                </div>


                {{-- Tombol --}}
                <button
                    type="submit"
                    class="btn btn-primary w-100">

                    <i class="bi bi-check-circle"></i>

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</div>