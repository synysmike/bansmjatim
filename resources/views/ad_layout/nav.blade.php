<!-- Header -->
<div class="navbar-bg"></div>
@auth
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand sidebar-gone-hide">BAN-PDM JATIM</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    
    <form class="form-inline ml-auto">
        <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    
    <!-- Profile Dropdown -->
    <ul class="navbar-nav navbar-right">        
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user" aria-expanded="false">
                <img alt="image" src="{{ asset('admin_theme/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in as</div>
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{ auth()->user()->name }}
                </a>
                @if(auth()->user()->username)
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-user-tag"></i> {{ auth()->user()->username }}
                </a>
                @endif
                @if(auth()->user()->kab_kota)
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-map-marker-alt"></i> {{ auth()->user()->kab_kota }}
                </a>
                @endif
                @if(auth()->user()->email)
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-envelope"></i> {{ auth()->user()->email }}
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.dashboard') }}" class="dropdown-item has-icon">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
@endauth