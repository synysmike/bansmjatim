<!-- Sidebar -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">BAN-PDM JATIM</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">BP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="menu-header">Content</li>
            <li class="nav-item">
                <a href="{{ route('admin.home.index') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Home Page</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.berita.index') }}" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.staff.index') }}" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Staff Management</span>
                </a>
            </li>
            
            @if(auth()->user()->hasRole('admin'))
            <li class="menu-header">Administration</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-users-cog"></i>
                    <span>Role & User Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.role-management.index') }}">
                            <i class="fas fa-th-large"></i> Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.role-management.users') }}">
                            <i class="fas fa-user"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.role-management.roles') }}">
                            <i class="fas fa-user-shield"></i> Roles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.role-management.permissions') }}">
                            <i class="fas fa-key"></i> Permissions
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.config.index') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Configuration</span>
                </a>
            </li>
            @endif
        </ul>        
    </aside>
</div>
