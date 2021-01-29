<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PERPUSTAKAAN</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PS</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Master Data</li>

            <?php if (session()->get('data_login')['level'] !== "PETUGAS") : ?>
                <li class="<?= ($sidebar == 1) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= route_to('view_petugas'); ?>">
                        <i class="fas fa-user"></i>
                        <span>Data Petugas</span>
                    </a>
                </li>
            <?php endif ?>

            <li class="<?= ($sidebar == 2) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= route_to('view_anggota'); ?>">
                    <i class="fas fa-user-tie"></i>
                    <span>Data Anggota</span>
                </a>
            </li>

            <li class="<?= ($sidebar == 3) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= route_to('view_buku'); ?>">
                    <i class="fas fa-hotel"></i>
                    <span>Data Buku</span>
                </a>
            </li>

            <li class="menu-header">Transaksi</li>
            <li class="<?= ($sidebar == 4) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= route_to('view_pinjam'); ?>">
                    <i class="fas fa-book"></i>
                    <span>Peminjaman Buku</span>
                </a>
            </li>

        </ul>
    </aside>
</div>