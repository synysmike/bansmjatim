@extends('ad_layout.wrapper')

@section('admin-container')
    <!-- Section Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-ubuntu font-bold text-admin-text-primary mb-2">{{ $tittle }}</h1>
        <nav class="flex items-center space-x-2 text-sm text-admin-text-secondary">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-admin-primary transition-colors">Dashboard</a>
            <span>/</span>
            <span class="text-admin-primary font-medium">{{ $tittle }}</span>
        </nav>
    </div>

    <!-- Welcome Card -->
    <div class="bg-white rounded-2xl shadow-admin p-6 mb-8 card-hover">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-ubuntu font-semibold text-admin-text-primary mb-2">
                    Welcome, {{ $user->name ?? 'Admin' }}!
                </h2>
                <p class="text-admin-text-secondary">Manage all aspects of the website from this dashboard.</p>
            </div>
            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-admin-primary to-admin-secondary shadow-admin flex-shrink-0">
                <i class="fas fa-tachometer-alt text-white admin-icon-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Management Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        <!-- Home Page -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-home text-white admin-icon-xl"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Home Page</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-admin-text-secondary text-sm mb-4">Manage homepage content and sections.</p>
                <a href="{{ route('admin.home.index') }}" class="inline-flex items-center space-x-2 text-admin-primary hover:text-admin-primary-dark font-medium transition-colors">
                    <span>Manage</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Berita -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-success to-emerald-600 p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-newspaper text-white admin-icon-xl"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Berita</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-admin-text-secondary text-sm mb-4">Manage news and articles.</p>
                <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center space-x-2 text-admin-success hover:text-emerald-700 font-medium transition-colors">
                    <span>Manage</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Staff -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-info to-blue-600 p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users text-white admin-icon-xl"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Staff</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-admin-text-secondary text-sm mb-4">Manage staff and sekretariat.</p>
                <a href="{{ route('admin.staff.index') }}" class="inline-flex items-center space-x-2 text-admin-info hover:text-blue-700 font-medium transition-colors">
                    <span>Manage</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Config -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-warning to-amber-500 p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-cog text-white admin-icon-xl"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Config</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-admin-text-secondary text-sm mb-4">Manage site configuration.</p>
                <a href="{{ route('admin.config.index') }}" class="inline-flex items-center space-x-2 text-admin-warning hover:text-amber-600 font-medium transition-colors">
                    <span>Manage</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Role & User (show for admin role) -->
        @if(auth()->user()->hasRole('admin'))
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover sm:col-span-2 lg:col-span-1">
            <div class="bg-gradient-to-r from-admin-danger to-red-600 p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-shield text-white admin-icon-xl"></i>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Role & User</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-admin-text-secondary text-sm mb-4">Manage users, roles and permissions.</p>
                <a href="{{ route('admin.role-management.index') }}" class="inline-flex items-center space-x-2 text-admin-danger hover:text-red-700 font-medium transition-colors">
                    <span>Manage</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Quick Access -->
    <div class="bg-white rounded-2xl shadow-admin p-6 card-hover">
        <h3 class="text-xl font-ubuntu font-semibold text-admin-text-primary mb-6">Quick Access</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
            <a href="{{ route('admin.home.index') }}" class="flex items-center space-x-4 p-4 rounded-xl border-2 border-admin-primary text-admin-text-primary hover:bg-admin-primary hover:text-white transition-all group">
                <i class="fas fa-home admin-icon-2xl text-admin-primary group-hover:text-white transition-colors"></i>
                <span class="font-semibold">Home Page</span>
            </a>
            <a href="{{ route('admin.berita.index') }}" class="flex items-center space-x-4 p-4 rounded-xl border-2 border-admin-success text-admin-text-primary hover:bg-admin-success hover:text-white transition-all group">
                <i class="fas fa-newspaper admin-icon-2xl text-admin-success group-hover:text-white transition-colors"></i>
                <span class="font-semibold">Berita</span>
            </a>
            <a href="{{ route('admin.staff.index') }}" class="flex items-center space-x-4 p-4 rounded-xl border-2 border-admin-info text-admin-text-primary hover:bg-admin-info hover:text-white transition-all group">
                <i class="fas fa-users admin-icon-2xl text-admin-info group-hover:text-white transition-colors"></i>
                <span class="font-semibold">Staff</span>
            </a>
            <a href="{{ route('admin.config.index') }}" class="flex items-center space-x-4 p-4 rounded-xl border-2 border-admin-warning text-admin-text-primary hover:bg-admin-warning hover:text-white transition-all group">
                <i class="fas fa-cog admin-icon-2xl text-admin-warning group-hover:text-white transition-colors"></i>
                <span class="font-semibold">Config</span>
            </a>
            @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.role-management.index') }}" class="flex items-center space-x-4 p-4 rounded-xl border-2 border-admin-danger text-admin-text-primary hover:bg-admin-danger hover:text-white transition-all group">
                <i class="fas fa-user-shield admin-icon-2xl text-admin-danger group-hover:text-white transition-colors"></i>
                <span class="font-semibold">Role & User</span>
            </a>
            @endif
        </div>
    </div>
@endsection
