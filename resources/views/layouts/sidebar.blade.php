<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">BelanjaIn</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item dropdown {{ isActive('dashboard') }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Data Master</li>

            <li class="nav-item dropdown {{ isActive('items.*') }}">
                <a href="{{ route('items.index') }}" class="nav-link">
                    <i class="fas fa-cubes"></i>
                    <span>Barang</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ isActive('customers.*') }}">
                <a href="{{ route('customers.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ isActive('transactions.*') }}">
                <a href="{{ route('transactions.index') }}" class="nav-link">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="menu-header">Manajemen Pengguna</li>
            <li class="nav-item dropdown {{ isActive('user') }}">
                <a href="#" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Pengguna</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" onclick="confirmLogout()" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-power-off"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
</div>
