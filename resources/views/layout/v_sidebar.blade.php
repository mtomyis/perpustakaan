<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Perpustakaan</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="/buku" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Kelola Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/peminjaman" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengembalian" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/denda" class="nav-link">
                        <i class="nav-icon bi bi-currency-dollar"></i>
                        <p>Kelola Denda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/anggota" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Kelola Anggota</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/buku-tamu" class="nav-link">
                        <i class="nav-icon bi bi-table"></i>
                        <p>Buku Tamu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan_tamu" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Laporan Tamu</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'kepala_sekolah')
                <li class="nav-item">
                    <a href="/laporan-kepala" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/laporan_tamu-kepala" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>Laporan Tamu</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'siswa')
                <li class="nav-item">
                    <a href="/lihat-buku" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Lihat Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/lihat-peminjaman" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Lihat Peminjaman</p>
                    </a>
                </li>
                @endif
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->