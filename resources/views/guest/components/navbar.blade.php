<nav class="navbar navbar-expand-lg fixed-top">

    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center"
            href="{{ route('guest.home') }}">

            <img
                src="{{ asset('assets/logo/logo.jpg') }}"
                alt="Logo Ruang Kreasi"
                class="logo">

            <div class="brand-text ms-2">

                <span>Ruang Kreasi</span>

                <small>Kabupaten Cirebon</small>

            </div>

        </a>

        {{-- Toggle Mobile --}}
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- Menu --}}
        <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarMenu">

            <ul class="navbar-nav align-items-lg-center">

                {{-- Beranda --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('guest.home') ? 'active' : '' }}"
                        href="{{ route('guest.home') }}">

                        Beranda

                    </a>

                </li>

                {{-- Tentang --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('guest.tentang') ? 'active' : '' }}"
                        href="{{ route('guest.tentang') }}">

                        Tentang Kami

                    </a>

                </li>

                {{-- Kegiatan --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('guest.kegiatan.*') ? 'active' : '' }}"
                        href="{{ route('guest.kegiatan.index') }}">

                        Kegiatan

                    </a>

                </li>

                {{-- Gallery --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('guest.gallery*') ? 'active' : '' }}"
                        href="{{ route('guest.gallery') }}">

                        Galeri Karya

                    </a>

                </li>

                {{-- Kontak --}}
                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('guest.kontak') ? 'active' : '' }}"
                        href="{{ route('guest.kontak') }}">

                        Kontak

                    </a>

                </li>

                {{-- Login --}}
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary px-4">

                        Log in

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>