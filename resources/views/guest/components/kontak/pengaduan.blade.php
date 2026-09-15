<div class="service-card">

    <div class="service-header">

        <h3>Layanan Pengaduan</h3>

        <p>
            Sampaikan kritik, saran maupun pengaduan kepada
            Ruang Kreasi Kabupaten Cirebon.
        </p>

    </div>

    <form
        action="{{ route('guest.pengaduan.store') }}"
        method="POST">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}">

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Subject

            </label>

            <input
                type="text"
                name="subject"
                class="form-control"
                value="{{ old('subject') }}">

        </div>

        <div class="mb-4">

            <label class="form-label">

                Pesan

            </label>

            <textarea
                rows="6"
                name="message"
                class="form-control">{{ old('message') }}</textarea>

        </div>

        <button
            class="btn btn-primary rounded-pill px-4">

            Kirim Pengaduan

        </button>

    </form>

</div>