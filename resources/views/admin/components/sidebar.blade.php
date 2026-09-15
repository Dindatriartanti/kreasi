<aside class="sidebar">

    <div class="sidebar-brand">

        <img
            src="{{ asset('assets/logo/logo.png') }}"
            alt="Logo">

        <div>

            <h5>Sistem Informasi</h5>

            <span>Ruang Kreasi</span>

        </div>

    </div>

    <ul class="nav flex-column">

        {{-- =========================
             DASHBOARD
        ========================== --}}

        <li class="nav-item">

            <a
                href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

        </li>

        {{-- =========================
             MASTER DATA
        ========================== --}}

        <li class="sidebar-title">

            MASTER DATA

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.user.index') }}"
                class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">

                <i class="bi bi-people"></i>

                User

            </a>

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.kategori.index') }}"
                class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">

                <i class="bi bi-tags"></i>

                Kategori

            </a>

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.kategori-kontributor.index') }}"
                class="nav-link {{ request()->routeIs('admin.kategori-kontributor.*') ? 'active' : '' }}">

                <i class="bi bi-diagram-3"></i>

                Kategori Kontributor

            </a>

        </li>

        {{-- =========================
             DATA
        ========================== --}}

        <li class="sidebar-title">

            DATA

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.kontributor.index') }}"
                class="nav-link {{ request()->routeIs('admin.kontributor.*') ? 'active' : '' }}">

                <i class="bi bi-person-badge"></i>

                Kontributor

            </a>

        </li>

        <li>
            <a
                href="{{ route('admin.rating.index') }}"
                class="nav-link
                    {{ request()->routeIs('admin.rating.*')
                        ? 'active'
                        : ''
                    }}"
            >
                <i class="bi bi-star me-2"></i>

                Rating Kontributor
            </a>
        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.karya.index') }}"
                class="nav-link {{ request()->routeIs('admin.karya.*') ? 'active' : '' }}">

                <i class="bi bi-images"></i>

                Moderasi Karya

            </a>

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.koleksi.index') }}"
                class="nav-link {{ request()->routeIs('admin.koleksi.*') ? 'active' : '' }}">

                <i class="bi bi-collection"></i>

                Koleksi

            </a>

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.kegiatan.index') }}"
                class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">

                <i class="bi bi-calendar-event"></i>

                Kegiatan

            </a>

        </li>

        {{-- =========================
             LAYANAN
        ========================== --}}

        <li class="sidebar-title">

            LAYANAN

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.booking.index') }}"
                class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">

                <i class="bi bi-calendar-check"></i>

                Booking

            </a>

        </li>

        <li class="nav-item">

            <a
                href="{{ route('admin.pengaduan.index') }}"
                class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">

                <i class="bi bi-chat-left-text"></i>

                <span>Pengaduan</span>

                @if(($pengaduanBelumDibaca ?? 0) > 0)

                    <span class="badge bg-danger ms-auto">

                        {{ $pengaduanBelumDibaca }}

                    </span>

                @endif

            </a>

        </li>

    </ul>

</aside>