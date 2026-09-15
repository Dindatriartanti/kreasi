<nav class="navbar navbar-expand-lg admin-navbar">

    <div class="container-fluid">

        {{-- ========================================= --}}
        {{-- Header --}}
        {{-- ========================================= --}}

        <div>

            <h4 class="navbar-title">

                {{ $title ?? 'Dashboard' }}

            </h4>

            <small class="navbar-subtitle">

                Selamat datang di Sistem Informasi Ruang Kreasi

            </small>

        </div>

        {{-- ========================================= --}}
        {{-- Right --}}
        {{-- ========================================= --}}

        <div class="d-flex align-items-center ms-auto">

            {{-- ========================================= --}}
            {{-- Notification --}}
            {{-- ========================================= --}}

            <div class="dropdown me-3">

                <button
                    class="btn btn-light notification-btn position-relative"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">

                    <i class="bi bi-bell fs-5"></i>

                    @if($totalNotif > 0)

                        <span class="notification-badge">

                            {{ $totalNotif }}

                        </span>

                    @endif

                </button>

                <div
                    class="dropdown-menu dropdown-menu-end notification-dropdown p-0">

                    {{-- Header --}}

                    <div class="notification-header">

                        <div>

                            <i class="bi bi-bell-fill me-2"></i>

                            Notifikasi

                        </div>

                        <span class="badge bg-primary">

                            {{ $totalNotif }}

                        </span>

                    </div>

                    {{-- Body --}}

                    <div class="notification-list">

                        @forelse($notifications as $item)

                            <a
                                href="{{ $item['url'] }}"
                                class="dropdown-item notification-item">

                                <div class="d-flex">

                                    {{-- Icon --}}

                                    <div class="notification-icon">

                                        <i class="bi {{ $item['icon'] }} {{ $item['color'] }}"></i>

                                    </div>

                                    {{-- Content --}}

                                    <div class="flex-grow-1">

                                        <div class="notification-title">

                                            {{ $item['title'] }}

                                        </div>

                                        <div class="notification-message">

                                            {{ $item['message'] }}

                                        </div>

                                        <div class="notification-time">

                                            <i class="bi bi-clock"></i>

                                            {{ $item['created_at']->diffForHumans() }}

                                        </div>

                                    </div>

                                </div>

                            </a>

                        @empty

                            <div class="notification-empty">

                                <i class="bi bi-bell-slash fs-1"></i>

                                <p>

                                    Tidak ada notifikasi baru

                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- ========================================= --}}
            {{-- User --}}
            {{-- ========================================= --}}

            <div class="dropdown">

                <button
                    class="btn btn-light user-button"
                    data-bs-toggle="dropdown">

                    <img
                        src="{{ asset('assets/images/avatar.png') }}"
                        class="rounded-circle"
                        width="42"
                        height="42">

                    <div class="user-info">

                        <div class="user-name">

                            {{ Auth::user()->name }}

                        </div>

                        <small>

                            Administrator

                        </small>

                    </div>

                    <i class="bi bi-chevron-down ms-2"></i>

                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                    <li>

                        <a
                            href="#"
                            class="dropdown-item">

                            <i class="bi bi-person-circle me-2"></i>

                            Profil

                        </a>

                    </li>

                    <li>

                        <a
                            href="#"
                            class="dropdown-item">

                            <i class="bi bi-gear me-2"></i>

                            Pengaturan

                        </a>

                    </li>

                    <li>

                        <hr class="dropdown-divider">

                    </li>

                    <li>

                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item text-danger">

                                <i class="bi bi-box-arrow-right me-2"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>