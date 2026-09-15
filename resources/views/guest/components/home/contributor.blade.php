<section class="contributor-section">

    <div class="container">

        <div class="row align-items-center gy-5">

            {{-- LEFT --}}
            <div class="col-lg-5">

                <span class="section-badge">
                    Kontributor
                </span>

                <h2 class="section-title text-start mt-3">
                    Temukan Kreator Lokal Terbaik
                </h2>

                <p class="section-subtitle text-start mx-0">

                    Jelajahi berbagai karya kreatif dari pelaku
                    ekonomi kreatif Kabupaten Cirebon yang berasal
                    dari berbagai subsektor ekonomi kreatif.

                </p>


                {{-- STATISTIC --}}

                <div class="contributor-stat">

                    <div>

                        <h3>
                            {{ $jumlahKontributor }}+
                        </h3>

                        <span>
                            Kontributor
                        </span>

                    </div>

                    <div>

                        <h3>
                            {{ $jumlahSubsektor }}
                        </h3>

                        <span>
                            Subsektor
                        </span>

                    </div>

                    <div>

                        <h3>
                            {{ $jumlahKarya }}+
                        </h3>

                        <span>
                            Karya
                        </span>

                    </div>

                </div>


                <a
                    href="{{ route('guest.gallery.kontributor.index') }}"
                    class="btn btn-primary rounded-pill px-4 mt-4">

                    Jelajahi Kontributor

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>


            {{-- RIGHT --}}

            <div class="col-lg-7">

                <div class="home-karya-grid">

                    @forelse($karyaTerbaru as $item)

                        <a
                            href="{{ route(
                                'guest.gallery.kontributor.karya.show',
                                [
                                    $item->kontributor,
                                    $item
                                ]
                            ) }}"
                            class="home-karya-item">

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    (
                                        $item->thumbnail
                                        ?: 'system/noimage.jpg'
                                    )
                                ) }}"
                                alt="{{ $item->judul_karya }}">

                            <div class="home-karya-overlay">

                                <span>
                                    {{ $item->kategoriKontributor->nama_kategori ?? 'Karya' }}
                                </span>

                                <h5>
                                    {{ Str::limit($item->judul_karya, 35) }}
                                </h5>

                                <small>
                                    {{ $item->kontributor->nama_kontributor ?? '' }}
                                </small>

                            </div>

                        </a>

                    @empty

                        <div class="home-empty">

                            <i class="bi bi-images"></i>

                            <h5>
                                Belum ada karya
                            </h5>

                            <p>
                                Karya yang telah dipublikasikan
                                akan tampil di sini.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</section>