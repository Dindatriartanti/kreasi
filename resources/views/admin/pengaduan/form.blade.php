<div class="row">

    <div class="col-lg-8">

        <div class="mb-3">

            <label class="form-label">
                Nama
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $pengaduan->name }}"
                readonly>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                class="form-control"
                value="{{ $pengaduan->email }}"
                readonly>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Subjek
            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $pengaduan->subject }}"
                readonly>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Pesan
            </label>

            <textarea
                class="form-control"
                rows="10"
                readonly>{{ $pengaduan->message }}</textarea>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">
                        Status Pengaduan
                    </label>

                    <select
                        name="is_read"
                        class="form-select">

                        <option value="0"
                            {{ !$pengaduan->is_read ? 'selected' : '' }}>
                            Belum Dibaca
                        </option>

                        <option value="1"
                            {{ $pengaduan->is_read ? 'selected' : '' }}>
                            Sudah Dibaca
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Pengaduan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $pengaduan->created_at->format('d M Y H:i') }}"
                        readonly>

                </div>

                <button class="btn btn-primary w-100">

                    <i class="bi bi-check-circle"></i>

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </div>

</div>