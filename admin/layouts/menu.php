    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li class="active"><a class="nav-link" href="index-0.html">General Dashboard</a>
                </li>
                <li class=""><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
            </ul>
        </li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : '' ?>"><a class="nav-link" href="../dashboard"><i class="far fa-square"></i> <span>Produk</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'produk') ? 'active' : '' ?>"><a class="nav-link" href="../produk"><i class="fas fa-boxes"></i> <span>Produk</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'pemasok') ? 'active' : '' ?>"><a class="nav-link" href="../pemasok"><i class="fas fa-industry"></i> <span>Pemasok</span></a></li>
        <li class="<?= strpos($_SERVER['REQUEST_URI'], 'kota') ? 'active' : '' ?>"><a class="nav-link" href="../kota"><i class="fas fa-map"></i> <span>Kota</span></a></li>
    </ul