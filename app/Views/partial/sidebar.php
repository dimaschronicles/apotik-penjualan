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
                <?php elseif (session('role') == 2) : ?>
                    <li class="nav-header">KARYAWAN</li>
                <?php endif; ?>
                <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : ''; ?>">
                    <a href="/dashboard" class="nav-link <?= ($title == 'Dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if (session('role') == 1) : ?>
                    <li class="nav-item <?= ($title == 'Data Karyawan') ? 'active' : ''; ?>">
                        <a href="/user" class="nav-link <?= ($title == 'Data Karyawan') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Karyawan</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session('role') == 1) : ?>
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
                <?php endif; ?>

                <li class="nav-item <?= ($title == 'Data Obat') ? 'active' : ''; ?>">
                    <a href="/obat" class="nav-link <?= ($title == 'Data Obat') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-briefcase-medical"></i>
                        <p>
                            Data Obat
                        </p>
                    </a>
                </li>
                <li class="nav-item <?= ($title == 'Obat Masuk') ? 'active' : ''; ?>">
                    <a href="/obatmasuk" class="nav-link <?= ($title == 'Obat Masuk') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>Obat Masuk</p>
                    </a>
                </li>
                <li class="nav-item <?= ($title == 'Obat Keluar') ? 'active' : ''; ?>">
                    <a href="/obatkeluar" class="nav-link <?= ($title == 'Obat Keluar') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Obat Keluar</p>
                    </a>
                </li>
                <li class="nav-item <?= ($title == 'Transaksi Obat') ? 'active' : ''; ?>">
                    <a href="/transaksi" class="nav-link <?= ($title == 'Transaksi Obat') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
                <!-- <li class="nav-item <?= ($title == 'Laporan Stok Obat') ? 'active' : ''; ?>">
                    <a href="/laporan" class="nav-link <?= ($title == 'Laporan Stok Obat') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li> -->
                <li class="nav-item <?= ($title == 'Laporan Obat' || $title == 'Laporan Transaksi' || $title == 'Laporan Stok Obat') ? 'menu-is-opening menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($title == 'Laporan Obat' || $title == 'Laporan Transaksi' || $title == 'Laporan Stok Obat') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/laporan" class="nav-link <?= ($title == 'Laporan Obat') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/laporan/sell" class="nav-link <?= ($title == 'Laporan Transaksi') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/laporan/stok" class="nav-link <?= ($title == 'Laporan Stok Obat') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Stok Obat</p>
                            </a>
                        </li>
                    </ul>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>