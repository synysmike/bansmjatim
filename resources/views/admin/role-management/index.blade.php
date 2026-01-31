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
    <div class="bg-white rounded-2xl shadow-admin p-6 mb-6 card-hover">
        <h2 class="text-2xl font-ubuntu font-semibold text-admin-text-primary mb-2">
            Welcome, {{ $user->name ?? 'Admin' }}!
        </h2>
        <p class="text-admin-text-secondary">Manage users, roles, and permissions from this dashboard.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Users Card -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-primary to-admin-secondary p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-white admin-icon-2xl"></i>
                        <h3 class="text-white font-semibold text-lg">Users</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-admin-text-primary mb-4">{{ $usersCount }}</div>
                <a href="{{ route('admin.role-management.users') }}" class="inline-flex items-center space-x-2 text-admin-primary hover:text-admin-primary-dark font-medium transition-colors">
                    <span>Manage Users</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Roles Card -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-success to-emerald-600 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-user-tag text-white admin-icon-2xl"></i>
                        <h3 class="text-white font-semibold text-lg">Roles</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-admin-text-primary mb-4">{{ $rolesCount }}</div>
                <a href="{{ route('admin.role-management.roles') }}" class="inline-flex items-center space-x-2 text-admin-success hover:text-emerald-700 font-medium transition-colors">
                    <span>Manage Roles</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>

        <!-- Permissions Card -->
        <div class="bg-white rounded-2xl shadow-admin overflow-hidden card-hover">
            <div class="bg-gradient-to-r from-admin-info to-blue-600 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-key text-white admin-icon-2xl"></i>
                        <h3 class="text-white font-semibold text-lg">Permissions</h3>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-admin-text-primary mb-4">{{ $permissionsCount }}</div>
                <a href="{{ route('admin.role-management.permissions') }}" class="inline-flex items-center space-x-2 text-admin-info hover:text-blue-700 font-medium transition-colors">
                    <span>Manage Permissions</span>
                    <i class="fas fa-arrow-right admin-icon-sm"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="bg-white rounded-2xl shadow-admin p-6 card-hover">
        <h3 class="text-xl font-ubuntu font-semibold text-admin-text-primary mb-6">Quick Access</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.role-management.users') }}" class="flex flex-col items-center justify-center p-6 border-2 border-admin-primary rounded-xl hover:bg-admin-primary hover:text-white transition-all group">
                <i class="fas fa-users admin-icon-2xl text-admin-primary group-hover:text-white mb-3 transition-colors"></i>
                <span class="font-semibold">User Management</span>
            </a>
            <a href="{{ route('admin.role-management.roles') }}" class="flex flex-col items-center justify-center p-6 border-2 border-admin-success rounded-xl hover:bg-admin-success hover:text-white transition-all group">
                <i class="fas fa-user-tag admin-icon-2xl text-admin-success group-hover:text-white mb-3 transition-colors"></i>
                <span class="font-semibold">Role Management</span>
            </a>
            <a href="{{ route('admin.role-management.permissions') }}" class="flex flex-col items-center justify-center p-6 border-2 border-admin-info rounded-xl hover:bg-admin-info hover:text-white transition-all group">
                <i class="fas fa-key admin-icon-2xl text-admin-info group-hover:text-white mb-3 transition-colors"></i>
                <span class="font-semibold">Permission Management</span>
            </a>
        </div>
    </div>
@endsection