<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="/img/apotek.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Apotek Alfia Farma</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if (session('role') == 1) : ?>
                    <li class="nav-header">ADMIN</li>
                <?php elseif (session('role') == 1) : ?>
                    <li class="nav-header">PETUGAS</li>
                <?php endif; ?>
                <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : ''; ?>">
                    <a href="/dashboard" class="nav-link <?= ($title == 'Dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= ($title == 'Barang' || $title == 'Supplier' || $title == 'Satuan' || $title == 'Jenis' || $title == 'Kategori') ? 'menu-is-opening menu-open' : ''; ?>">
                    <a href="/barang" class="nav-link <?= ($title == 'Barang' || $title == 'Supplier' || $title == 'Satuan' || $title == 'Jenis' || $title == 'Kategori') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/barang" class="nav-link <?= ($title == 'Barang') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jenis" class="nav-link <?= ($title == 'Jenis') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link <?= ($title == 'Kategori') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/supplier" class="nav-link <?= ($title == 'Supplier') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="/satuan" class="nav-link <?= ($title == 'Satuan') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satuan</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <li class="nav-item <?= ($title == 'Data Obat') ? 'active' : ''; ?>">
                    <a href="/obat" class="nav-link <?= ($title == 'Data Obat') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-briefcase-medical"></i>
                        <p>
                            Data Obat
                        </p>
                    </a>
                </li>
                <li class="nav-item <?= ($title == 'Obat Masuk' || $title == 'Obat Keluar') ? 'menu-is-opening menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($title == 'Obat Masuk' || $title == 'Obat Keluar') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/obatmasuk" class="nav-link <?= ($title == 'Obat Masuk') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Obat Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/obatkeluar" class="nav-link <?= ($title == 'Obat Keluar') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Obat Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item <?= ($title == 'Laporan Data Obat' || $title == 'Laporan Obat Masuk' || $title == 'Laporan Obat Keluar') ? 'menu-is-opening menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($title == 'Laporan Data Obat' || $title == 'Laporan Obat Masuk' || $title == 'Laporan Obat Keluar') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/laporanobatmasuk" class="nav-link <?= ($title == 'Laporan Obat Masuk') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Obat Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/laporanobatkeluar" class="nav-link <?= ($title == 'Laporan Obat Keluar') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Obat Keluar</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="nav-item <?= ($title == 'Laporan') ? 'active' : ''; ?>">
                    <a href="/laporan" class="nav-link <?= ($title == 'Laporan') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>