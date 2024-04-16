<!-- Header -->
<div class="navbar-bg"></div>
@auth
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="index.html" class="navbar-brand sidebar-gone-hide">BAN-S/M JATIM</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    
    <form class="form-inline ml-auto">
        <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        
    </form>
    <ul class="navbar-nav navbar-right">        
        
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user" aria-expanded="false">
                <img alt="image" src="/admin_theme/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <p class="dropdown-item">username : {{ auth()->user()->username }}</p>
                <p class="dropdown-item">Kab./Kota : {{ auth()->user()->kab_kota }}</p>
                    <form action="/logout"  method="post">                        
                        @csrf
                        <button type="submit" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i>Logout</button>
                    </form>
            </div>
        </li>
    </ul>
</nav>
@endauth