<section class="collection-section">

    <div class="container">

        <div class="section-header">

            <span class="section-badge">
                Museum
            </span>

            <h2 class="section-title mt-3">
                Koleksi Pilihan
            </h2>

            <p class="section-subtitle">

                Jelajahi koleksi sejarah, budaya,
                dan peninggalan Kabupaten Cirebon.

            </p>

        </div>


        @if($koleksiTerbaru->count())

            <div class="home-collection-grid">

                {{-- FEATURED --}}

                @if(isset($koleksiTerbaru[0]))

                    <a
                        href="{{ route(
                            'guest.gallery.museum.show',
                            $koleksiTerbaru[0]
                        ) }}"
                        class="home-collection-feature">

                        @if($koleksiTerbaru[0]->gambar ?? $koleksiTerbaru[0]->thumbnail)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    (
                                        $koleksiTerbaru[0]->gambar
                                        ?? $koleksiTerbaru[0]->thumbnail
                                    )
                                ) }}"
                                alt="">

                        @else

                            <div class="collection-placeholder">
                                <i class="bi bi-bank"></i>
                            </div>

                        @endif

                        <div class="home-collection-overlay">

                            <span>
                                Koleksi
                            </span>

                            <h3>
                                {{
                                    $koleksiTerbaru[0]->nama_koleksi
                                    ?? $koleksiTerbaru[0]->judul
                                    ?? '-'
                                }}
                            </h3>

                        </div>

                    </a>

                @endif


                {{-- SMALL COLLECTIONS --}}

                <div class="home-collection-side">

                    @foreach($koleksiTerbaru->skip(1)->take(3) as $koleksi)

                        <a
                            href="{{ route(
                                'guest.gallery.museum.show',
                                $koleksi
                            ) }}"
                            class="home-collection-small">

                            @if($koleksi->gambar ?? $koleksi->thumbnail)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        (
                                            $koleksi->gambar
                                            ?? $koleksi->thumbnail
                                        )
                                    ) }}"
                                    alt="">

                            @else

                                <div class="collection-placeholder">
                                    <i class="bi bi-bank"></i>
                                </div>

                            @endif

                            <div class="home-collection-small-overlay">

                                <h5>

                                    {{
                                        $koleksi->nama_koleksi
                                        ?? $koleksi->judul
                                        ?? '-'
                                    }}

                                </h5>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>


            <div class="text-center mt-5">

                <a
                    href="{{ route('guest.gallery.museum.index') }}"
                    class="btn btn-outline-primary rounded-pill px-4">

                    Lihat Semua Koleksi

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

        @else

            <div class="home-empty">

                <i class="bi bi-bank"></i>

                <h5>
                    Belum ada koleksi
                </h5>

            </div>

        @endif

    </div>

</section>