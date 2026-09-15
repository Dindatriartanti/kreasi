<section class="activity-section">

    <div class="container">

        <div class="d-flex justify-content-between align-items-end mb-5">

            <div>

                <span class="section-badge">
                    Kegiatan
                </span>

                <h2 class="section-title text-start mt-3">
                    Aktivitas Ruang Kreasi
                </h2>

                <p class="text-muted mb-0">

                    Informasi kegiatan dan aktivitas
                    ekonomi kreatif Kabupaten Cirebon.

                </p>

            </div>

            <a
                href="{{ route('guest.kegiatan.index') }}"
                class="btn btn-outline-primary rounded-pill">

                Lihat Semua

                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>


        <div class="home-event-list">

            @forelse($kegiatanTerbaru as $kegiatan)

                <a
                    href="{{ route('guest.kegiatan.show', $kegiatan) }}"
                    class="home-event-item">


                    {{-- POSTER --}}
                    <div class="home-event-image">

                        @if($kegiatan->poster)

                            <img
                                src="{{ asset('storage/' . $kegiatan->poster) }}"
                                alt="{{ $kegiatan->nama_kegiatan }}">

                        @else

                            <div class="home-event-placeholder">

                                <i class="bi bi-calendar-event"></i>

                            </div>

                        @endif

                    </div>


                    {{-- TANGGAL --}}
                    <div class="home-event-date">

                        @if($kegiatan->tanggal_mulai)

                            <strong>

                                {{ $kegiatan->tanggal_mulai->format('d') }}

                            </strong>

                            <span>

                                {{ $kegiatan->tanggal_mulai->format('M') }}

                            </span>

                        @else

                            <i class="bi bi-calendar-event"></i>

                        @endif

                    </div>


                    {{-- INFORMASI --}}
                    <div class="home-event-content">

                        <span>
                            Kegiatan
                        </span>

                        <h5>

                            {{ $kegiatan->nama_kegiatan }}

                        </h5>

                        <small class="text-muted">

                            <i class="bi bi-geo-alt me-1"></i>

                            {{ $kegiatan->lokasi_kegiatan ?: 'Lokasi belum ditentukan' }}

                        </small>

                    </div>


                    <i class="bi bi-arrow-up-right"></i>

                </a>

            @empty

                <div class="home-empty">

                    <i class="bi bi-calendar-event"></i>

                    <h5>
                        Belum ada kegiatan
                    </h5>

                    <p class="text-muted">
                        Belum ada kegiatan yang dipublikasikan.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>