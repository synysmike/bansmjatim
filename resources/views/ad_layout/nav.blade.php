@auth
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; letter-spacing: -0.02em; font-weight: 600;">
            <i class="fas fa-shield-alt me-2"></i>
            BAN-PDM JATIM
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="box-shadow: none;">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-3 py-2 rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgba(255, 255, 255, 0.1); transition: all 0.3s;">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                            <i class="fas fa-user text-primary" style="font-size: 0.875rem;"></i>
                        </div>
                        <span class="d-none d-lg-inline fw-medium">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down ms-2" style="font-size: 0.75rem;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="navbarDropdown" style="border-radius: 12px; padding: 0.5rem; margin-top: 0.5rem; min-width: 250px;">
                        <li>
                            <h6 class="dropdown-header text-muted fw-normal" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Logged in as</h6>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="#" style="transition: all 0.2s;">
                                <i class="far fa-user me-3 text-primary"></i>
                                <div>
                                    <div class="fw-medium">{{ auth()->user()->name }}</div>
                                    <small class="text-muted">Full Name</small>
                                </div>
                            </a>
                        </li>
                        @if(auth()->user()->username)
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="#" style="transition: all 0.2s;">
                                <i class="fas fa-user-tag me-3 text-primary"></i>
                                <div>
                                    <div class="fw-medium">{{ auth()->user()->username }}</div>
                                    <small class="text-muted">Username</small>
                                </div>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->kab_kota)
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="#" style="transition: all 0.2s;">
                                <i class="fas fa-map-marker-alt me-3 text-primary"></i>
                                <div>
                                    <div class="fw-medium">{{ auth()->user()->kab_kota }}</div>
                                    <small class="text-muted">Location</small>
                                </div>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->email)
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="#" style="transition: all 0.2s;">
                                <i class="far fa-envelope me-3 text-primary"></i>
                                <div>
                                    <div class="fw-medium" style="font-size: 0.875rem;">{{ auth()->user()->email }}</div>
                                    <small class="text-muted">Email</small>
                                </div>
                            </a>
                        </li>
                        @endif
                        <li><hr class="dropdown-divider my-2"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="{{ route('admin.dashboard') }}" style="transition: all 0.2s;">
                                <i class="fas fa-tachometer-alt me-3 text-primary"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-2"></li>
                        <li>
                            <form action="/logout" method="post" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center py-2 px-3 rounded w-100 text-danger" style="transition: all 0.2s; border: none; background: none;">
                                    <i class="fas fa-sign-out-alt me-3"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar .dropdown-item:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        transform: translateX(4px);
    }
    
    .navbar .dropdown-item:hover i {
        color: white !important;
    }
    
    .navbar .nav-link:hover {
        background: rgba(255, 255, 255, 0.2) !important;
    }
</style>
@endauth