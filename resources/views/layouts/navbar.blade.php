<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="http://[::1]/codepos-app/uploads/user/1dadb10576865070a01a094e51c67fb6.jpg" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <b>{{ auth()->user()->name }}</b></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i>
                    <span>Profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item has-icon text-danger" href="#"
                   onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
            </div>
        </li>
    </ul>
</nav>
