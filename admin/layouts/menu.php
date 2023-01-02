    <ul class="sidebar-menu">
    <li class="<?= strpos($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>"><a class="nav-link" href="../dashboard"><i class="far fa-square"></i> <span>Dashboard</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'produk') ? 'active' : '' ?>"><a class="nav-link" href="../produk"><i class="fas fa-boxes"></i> <span>Produk</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'pemasok') ? 'active' : '' ?>"><a class="nav-link" href="../pemasok"><i class="fas fa-industry"></i> <span>Pemasok</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'kota') ? 'active' : '' ?>"><a class="nav-link" href="../kota"><i class="fas fa-map"></i> <span>Kota</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'transaksi') ? 'active' : '' ?>"><a class="nav-link" href="../transaksi"><i class="fas fa-shopping-cart"></i> <span>Transaksi</span></a></li>
        </ul