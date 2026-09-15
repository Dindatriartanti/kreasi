<nav id="sidebar" class="p-3 d-flex flex-column">
        <!-- Brand/Logo -->
    <a href="#" class="d-flex flex-column align-items-center text-dark text-decoration-none mb-4">
        <i class="fas fa-store-alt fa-3x text-primary mb-2"></i>
        <span class="fw-bold text-center">PT. Solusi Koneksi Anda</span>
    </a>

    <div class="sidebar-nav-wrapper">
        <!-- Navigation Links -->
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-home fa-fw me-2"></i>Dashboard
                </a>
            </li>

            <!-- Pemisah Teks untuk Master Data -->
            <li class="nav-heading px-3 mt-3 mb-1 text-muted text-uppercase small">
                Master Data
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                    <i class="fas fa-tags fa-fw me-2"></i>Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.kegiatan.index') }}">
                    <i class="fas fa-calendar-alt fa-fw me-2"></i>Kegiatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.koleksi.index') }}">
                    <i class="fas fa-box-archive fa-fw me-2"></i>Galeri & Karya
                </a>
            </li>

            <!-- Pemisah Teks untuk layanan pengunjung -->
            <li class="nav-heading px-3 mt-3 mb-1 text-muted text-uppercase small">
                Layanan Pengunjung 
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.kunjungan.index') }}">
                    <i class="fas fa-calendar-alt fa-fw me-2"></i>Kunjungan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pengaduan.index') }}">
                    <i class="fas fa-calendar-alt fa-fw me-2"></i>Pengaduan
                </a>
            </li>

            {{-- <!-- Pemisah Teks untuk Manajemen User -->
            <li class="nav-heading px-3 mt-3 mb-1 text-muted text-uppercase small">
                Manajemen User
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-shield fa-fw me-2"></i>Role
                </a>
            </li> --}}
        </ul>
    </div>
    @auth
    <!-- User Profile Section -->
    <div class="profile-section mt-auto">
        <div class="d-flex align-items-center">
            <!-- Avatar dinamis berdasarkan inisial nama user -->
            <img src="https://placehold.co/60x60/7E57C2/white?text={{ substr(Auth::user()->name, 0, 1) }}" class="rounded-circle me-3" alt="User Avatar" onerror="this.onerror=null;this.src='https://placehold.co/60x60/EFEFEF/333?text=U';">
            
            <div class="me-auto">
                <!-- Menampilkan nama user yang sedang login -->
                <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
                <!-- Menampilkan nama role dari user yang login, dengan fallback 'User' -->
                <small class="text-muted profile-role">{{ Auth::user()->role ?? 'User' }}</small>
            </div>
            
            <!-- Tombol Logout -->
            <a href="{{ route('logout') }}" class="logout-link" title="Logout" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-fw fs-5"></i>
            </a>

            <!-- Form tersembunyi untuk proses logout (metode POST) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    @endauth 
</nav>