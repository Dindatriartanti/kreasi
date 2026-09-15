<aside class="sidebar">

    {{-- =========================
         Logo
    ========================== --}}

    <div class="sidebar-header">

        <img
            src="{{ asset('assets/logo/logo.png') }}"
            alt="Logo"
            class="sidebar-logo">

        <h6 class="mt-3 mb-0 fw-bold">

            Ruang Kreasi

        </h6>

        <small class="text-muted">

            Kabupaten Cirebon

        </small>

    </div>

    {{-- =========================
         Menu
    ========================== --}}

    <ul class="sidebar-menu">

        {{-- Dashboard --}}

        <li>

            <a
                href="{{ route('kontributor.dashboard') }}"
                class="{{ request()->routeIs('kontributor.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

        </li>

        {{-- Profil --}}

        <li>

            <a
                href="{{ route('kontributor.profil.show') }}"
                class="{{ request()->routeIs('kontributor.profil.*') ? 'active' : '' }}">

                <i class="bi bi-person-circle"></i>

                Profil Saya

            </a>

        </li>

        {{-- Karya Saya --}}

        <li>

            <a
                href="{{ route('kontributor.karya.index') }}"
                class="{{ request()->routeIs(
                    'kontributor.karya.index',
                    'kontributor.karya.create',
                    'kontributor.karya.show',
                    'kontributor.karya.edit'
                ) ? 'active' : '' }}">

                <i class="bi bi-images"></i>

                Karya Saya

            </a>

        </li>

        {{-- Sedang Diajukan --}}

        <li>

            <a
                href="{{ route('kontributor.karya.review') }}"
                class="{{ request()->routeIs('kontributor.karya.review') ? 'active' : '' }}">

                <i class="bi bi-hourglass-split"></i>

                Sedang Diajukan

            </a>

        </li>
        <li>
            <a
                href="{{ route('kontributor.rating.index') }}"
                class="nav-link
                    {{ request()->routeIs('kontributor.rating.*')
                        ? 'active'
                        : ''
                    }}"
            >
                <i class="bi bi-star me-2"></i>

                Rating & Komentar
            </a>
        </li>

    </ul>

    {{-- =========================
         Footer Sidebar
    ========================== --}}

    <div class="sidebar-footer">

        @if(isset($kontributor))

            <div class="sidebar-user">

                <img
                    src="{{ asset('storage/' . ($kontributor->foto_profil ?: 'system/defaultProfil.png')) }}"
                    class="rounded-circle"
                    width="45"
                    height="45"
                    style="object-fit:cover;">

                <div>

                    <strong>

                        {{ $kontributor->nama_kontributor }}

                    </strong>

                    <br>

                    <small class="text-muted">

                        Kontributor

                    </small>

                </div>

            </div>

        @endif

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="mt-3">

            @csrf

            <button
                type="submit"
                class="btn btn-outline-danger w-100">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </button>

        </form>

    </div>

</aside>