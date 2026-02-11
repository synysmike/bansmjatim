@auth
<nav class="bg-gradient-to-r from-admin-primary to-admin-secondary shadow-admin-md sticky top-0 z-50" x-data="{ menuOpen: false, roleOpen: false }">
    <div class="px-4 sm:px-6">
        <div class="flex items-center justify-between h-14">
            <!-- Mobile Menu Toggle (visible only on mobile, hidden from md breakpoint up) -->
            <button @click="menuOpen = !menuOpen" class="nav-mobile-toggle inline-flex md:hidden items-center justify-center text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all" aria-label="Toggle menu">
                <i class="fas fa-bars admin-icon-lg"></i>
            </button>

            <!-- Brand -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-white font-ubuntu text-xl font-semibold tracking-tight hover:opacity-90 transition-opacity">
                <i class="fas fa-shield-alt admin-icon-lg"></i>
                <span class="hidden sm:inline">BAN-PDM JATIM</span>
                <span class="sm:hidden">BP</span>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center space-x-1 flex-1 justify-center max-w-3xl">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Dashboard</a>
                @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.home.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Home</a>
                @endif
                <a href="{{ route('admin.berita.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Berita</a>
                <a href="{{ route('admin.staff.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Staff</a>
                @if(auth()->user()->hasRole('admin'))
                <div class="relative" @click.away="roleOpen = false">
                    <button @click="roleOpen = !roleOpen" class="flex items-center space-x-1 px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">
                        <span>Role & User</span>
                        <i class="fas fa-chevron-down admin-icon-sm transition-transform" :class="{ 'rotate-180': roleOpen }"></i>
                    </button>
                    <div x-show="roleOpen"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute top-full left-0 mt-1 min-w-[180px] bg-white rounded-lg shadow-admin-lg border border-admin-border py-1 z-50">
                        <a href="{{ route('admin.role-management.index') }}" class="block px-4 py-2 text-sm text-admin-text-primary hover:bg-admin-light">Overview</a>
                        <a href="{{ route('admin.role-management.users') }}" class="block px-4 py-2 text-sm text-admin-text-primary hover:bg-admin-light">Users</a>
                        <a href="{{ route('admin.role-management.roles') }}" class="block px-4 py-2 text-sm text-admin-text-primary hover:bg-admin-light">Roles</a>
                        <a href="{{ route('admin.role-management.permissions') }}" class="block px-4 py-2 text-sm text-admin-text-primary hover:bg-admin-light">Permissions</a>
                    </div>
                </div>
                @endif
                <a href="{{ route('admin.config.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Kegiatan Umum</a>
                <a href="{{ route('admin.judul_absen.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Kegiatan Internal</a>
                <a href="{{ route('admin.form-builder.index') }}" class="px-3 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all text-sm font-medium">Form Builder</a>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 transition-all text-white">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user admin-icon-sm text-admin-primary"></i>
                    </div>
                    <span class="hidden lg:inline font-medium text-sm truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down admin-icon-sm flex-shrink-0"></i>
                </button>

                <div x-show="open"
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-admin-xl border border-admin-border overflow-hidden z-50">
                    <div class="px-4 py-3 bg-admin-light border-b border-admin-border">
                        <p class="text-xs uppercase tracking-wider text-admin-text-secondary font-semibold">Logged in as</p>
                    </div>
                    <div class="px-4 py-3 border-b border-admin-border">
                        <div class="flex items-center space-x-3">
                            <i class="far fa-user admin-icon text-admin-primary"></i>
                            <div class="min-w-0">
                                <div class="font-semibold text-admin-text-primary truncate">{{ auth()->user()->name }}</div>
                                <small class="text-admin-text-secondary">Full Name</small>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->username)
                    <div class="px-4 py-3 border-b border-admin-border hover:bg-admin-light transition-colors">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-user-tag admin-icon text-admin-primary"></i>
                            <div>
                                <div class="font-semibold text-admin-text-primary">{{ auth()->user()->username }}</div>
                                <small class="text-admin-text-secondary">Username</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(auth()->user()->kab_kota)
                    <div class="px-4 py-3 border-b border-admin-border hover:bg-admin-light transition-colors">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt admin-icon text-admin-primary"></i>
                            <div>
                                <div class="font-semibold text-admin-text-primary">{{ auth()->user()->kab_kota }}</div>
                                <small class="text-admin-text-secondary">Location</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(auth()->user()->email)
                    <div class="px-4 py-3 border-b border-admin-border hover:bg-admin-light transition-colors">
                        <div class="flex items-center space-x-3">
                            <i class="far fa-envelope admin-icon text-admin-primary"></i>
                            <div class="min-w-0">
                                <div class="font-semibold text-admin-text-primary text-sm truncate">{{ auth()->user()->email }}</div>
                                <small class="text-admin-text-secondary">Email</small>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="border-t border-admin-border"></div>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 hover:bg-admin-light transition-colors text-admin-text-primary">
                        <i class="fas fa-tachometer-alt admin-icon text-admin-primary"></i>
                        <span>Dashboard</span>
                    </a>
                    <div class="border-t border-admin-border"></div>
                    <form action="/logout" method="post" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 hover:bg-red-50 transition-colors text-red-600 text-left">
                            <i class="fas fa-sign-out-alt admin-icon"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Panel -->
    <div x-show="menuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         class="md:hidden border-t border-white border-opacity-20 bg-admin-primary">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-tachometer-alt admin-icon w-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.home.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-home admin-icon w-5"></i>
                <span class="font-medium">Home Page</span>
            </a>
            @endif
            <a href="{{ route('admin.berita.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-newspaper admin-icon w-5"></i>
                <span class="font-medium">Berita</span>
            </a>
            <a href="{{ route('admin.staff.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-users admin-icon w-5"></i>
                <span class="font-medium">Staff Management</span>
            </a>
            @if(auth()->user()->hasRole('admin'))
            <div class="pt-2 pb-1">
                <p class="px-4 text-xs font-semibold text-white text-opacity-80 uppercase tracking-wider">Administration</p>
            </div>
            <a href="{{ route('admin.role-management.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-th-large admin-icon w-5"></i>
                <span class="font-medium">Role & User Overview</span>
            </a>
            <a href="{{ route('admin.role-management.users') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all pl-8">
                <i class="fas fa-user admin-icon w-4"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.role-management.roles') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all pl-8">
                <i class="fas fa-user-shield admin-icon w-4"></i>
                <span>Roles</span>
            </a>
            <a href="{{ route('admin.role-management.permissions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all pl-8">
                <i class="fas fa-key admin-icon w-4"></i>
                <span>Permissions</span>
            </a>
            @endif
            <a href="{{ route('admin.config.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-cog admin-icon w-5"></i>
                <span class="font-medium">Kegiatan Umum</span>
            </a>
            <a href="{{ route('admin.judul_absen.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-calendar-check admin-icon w-5"></i>
                <span class="font-medium">Kegiatan Internal</span>
            </a>
            <a href="{{ route('admin.form-builder.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white hover:bg-opacity-15 transition-all">
                <i class="fas fa-wpforms admin-icon w-5"></i>
                <span class="font-medium">Form Builder</span>
            </a>
        </div>
    </div>
</nav>
@endauth
